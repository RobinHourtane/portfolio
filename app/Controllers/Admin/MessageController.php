<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ContactMessageModel;

class MessageController extends Controller
{
    private ContactMessageModel $messages;

    public function __construct()
    {
        $this->messages = new ContactMessageModel();
    }

    public function index(): void
    {
        \requireLogin();

        $readId = filter_input(INPUT_GET, 'read', FILTER_VALIDATE_INT);
        if ($readId) {
            $this->messages->markRead($readId);
            $this->redirectTo('admin/messages.php');
        }

        $deleteId = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
        if ($deleteId) {
            $this->messages->delete($deleteId);
            $this->redirectTo('admin/messages.php');
        }

        $this->renderAdmin('admin/messages', [
            'pageTitle' => 'Messages',
            'adminSection' => 'messages',
            'messages' => $this->messages->getAll(),
        ]);
    }
}
