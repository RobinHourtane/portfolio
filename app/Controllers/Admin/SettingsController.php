<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\AdminModel;
use App\Models\SettingModel;

class SettingsController extends Controller
{
    private const ABOUT_IMAGE_SETTING_KEY = 'about_image';
    private const SCRATCH_IMAGE_SETTING_KEY = 'scratch_image';

    private SettingModel $settings;
    private AdminModel $admins;

    public function __construct()
    {
        $this->settings = new SettingModel();
        $this->admins = new AdminModel();
    }

    public function index(): void
    {
        \requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!\verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die('Erreur CSRF');
            }

            $settingsToSave = [];
            foreach (['github_link', 'email', 'phone', 'bio'] as $key) {
                if (isset($_POST[$key])) {
                    $settingsToSave[$key] = trim((string) $_POST[$key]);
                }
            }

            $uploadError = $this->handleAboutImageUpload(
                $settingsToSave,
                $_FILES['about_image'] ?? null,
                isset($_POST['remove_about_image'])
            );

            if ($uploadError !== null) {
                $this->redirectTo('admin/settings.php?error=' . $uploadError);
            }

            $uploadError = $this->handleScratchImageUpload(
                $settingsToSave,
                $_FILES['scratch_image'] ?? null,
                isset($_POST['remove_scratch_image'])
            );

            if ($uploadError !== null) {
                $this->redirectTo('admin/settings.php?error=' . $uploadError);
            }

            $this->settings->saveMany($settingsToSave);

            $newPassword = (string) ($_POST['new_password'] ?? '');
            if ($newPassword !== '' && isset($_SESSION['admin_id'])) {
                $this->admins->updatePassword((int) $_SESSION['admin_id'], password_hash($newPassword, PASSWORD_DEFAULT));
            }

            $this->redirectTo('admin/settings.php?success=1');
        }

        $currentSettings = $this->settings->allKeyed();

        $this->renderAdmin('admin/settings', [
            'pageTitle' => 'Paramètres',
            'adminSection' => 'settings',
            'currentSettings' => $currentSettings,
            'currentAboutImageUrl' => \aboutImageUrl($currentSettings[self::ABOUT_IMAGE_SETTING_KEY] ?? null),
            'currentScratchImageUrl' => \scratchImageUrl($currentSettings[self::SCRATCH_IMAGE_SETTING_KEY] ?? null),
            'errorMessage' => $this->errorMessage((string) ($_GET['error'] ?? '')),
            'success' => isset($_GET['success']),
        ]);
    }

    private function handleAboutImageUpload(array &$settingsToSave, ?array $file, bool $removeImage): ?string
    {
        return $this->handleSettingImageUpload(
            $settingsToSave,
            $file,
            $removeImage,
            self::ABOUT_IMAGE_SETTING_KEY,
            'about_',
            'about-image-upload',
            'about-image-directory'
        );
    }

    private function handleScratchImageUpload(array &$settingsToSave, ?array $file, bool $removeImage): ?string
    {
        return $this->handleSettingImageUpload(
            $settingsToSave,
            $file,
            $removeImage,
            self::SCRATCH_IMAGE_SETTING_KEY,
            'scratch_',
            'scratch-image-upload',
            'scratch-image-directory'
        );
    }

    private function handleSettingImageUpload(
        array &$settingsToSave,
        ?array $file,
        bool $removeImage,
        string $settingKey,
        string $prefix,
        string $uploadErrorCode,
        string $directoryErrorCode
    ): ?string
    {
        $currentImage = (string) $this->settings->get($settingKey, '');
        $shouldRemoveCurrentImage = $removeImage;

        if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            if ($shouldRemoveCurrentImage) {
                $this->deleteCurrentSettingImage($currentImage);
                $settingsToSave[$settingKey] = '';
            }

            return null;
        }

        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            return $uploadErrorCode;
        }

        if (!is_dir(SETTINGS_UPLOADS_PATH) && !mkdir(SETTINGS_UPLOADS_PATH, 0775, true) && !is_dir(SETTINGS_UPLOADS_PATH)) {
            return $directoryErrorCode;
        }

        $uploadedImage = \uploadImage($file, SETTINGS_UPLOADS_PATH, $prefix);
        if ($uploadedImage === false) {
            return $uploadErrorCode;
        }

        $this->deleteCurrentSettingImage($currentImage, $uploadedImage);
        $settingsToSave[$settingKey] = $uploadedImage;

        return null;
    }

    private function deleteCurrentSettingImage(string $filename, ?string $except = null): void
    {
        $safeFilename = basename(trim($filename));
        if ($safeFilename === '') {
            return;
        }

        if ($except !== null && $safeFilename === basename(trim($except))) {
            return;
        }

        \deleteImage($safeFilename, SETTINGS_UPLOADS_PATH);
    }

    private function errorMessage(string $code): ?string
    {
        return match ($code) {
            'about-image-upload' => "L'image de biographie n'a pas pu etre enregistree. Verifie le format (jpg, png, webp, gif) et la taille maximale de 5 Mo.",
            'about-image-directory' => "Le dossier d'upload de l'image de biographie n'a pas pu etre cree.",
            'scratch-image-upload' => "L'image a gratter n'a pas pu etre enregistree. Verifie le format (jpg, png, webp, gif) et la taille maximale de 5 Mo.",
            'scratch-image-directory' => "Le dossier d'upload de l'image a gratter n'a pas pu etre cree.",
            default => null,
        };
    }
}
