<div class="about-container">
    <section class="ide-column">
        <aside class="ide-sidebar">
            <div class="sidebar-header">
                <span>EXPLORATEUR</span>
            </div>

            <div class="mobile-sidebar-panel">
                <label class="mobile-sidebar-label" for="about-mobile-file-select">navigation_mobile</label>
                <div class="mobile-sidebar-select-shell" data-mobile-select-shell data-accent="rose">
                    <span class="mobile-sidebar-select-accent" aria-hidden="true"></span>
                    <span class="mobile-sidebar-select-icon" data-mobile-select-icon aria-hidden="true">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    <span class="mobile-sidebar-select-meta">
                        <span class="mobile-sidebar-select-group" data-mobile-select-group>infos_perso / bio</span>
                        <span class="mobile-sidebar-select-value" data-mobile-select-value>biographie.txt</span>
                    </span>
                    <span class="mobile-sidebar-select-caret" aria-hidden="true">
                        <i class="fas fa-chevron-down"></i>
                    </span>

                    <select id="about-mobile-file-select" class="mobile-sidebar-select" data-mobile-about-select>
                        <optgroup label="infos_perso / bio">
                            <option value="biography" data-group="infos_perso / bio" data-icon="fas fa-file-alt" data-accent="rose">biographie.txt</option>
                        </optgroup>
                        <optgroup label="infos_perso / interests">
                            <option value="passions" data-group="infos_perso / interests" data-icon="fas fa-file-alt" data-accent="turquoise">mes_passions.md</option>
                        </optgroup>
                        <optgroup label="infos_perso / Education">
                            <option value="diplomas" data-group="infos_perso / Education" data-icon="fas fa-graduation-cap" data-accent="blue">mes_diplomes.json</option>
                            <option value="cv" data-group="infos_perso / Education" data-icon="fas fa-file-pdf" data-accent="rose">mon_cv.pdf</option>
                        </optgroup>
                    </select>
                </div>

                <div class="mobile-sidebar-links">
                    <a href="mailto:<?= escape($contactEmail) ?>" class="mobile-sidebar-link">mail()</a>
                    <a href="tel:<?= escape($contactPhone) ?>" class="mobile-sidebar-link">call()</a>
                </div>
            </div>

            <div class="sidebar-content">
                <div class="folder is-open">
                    <div class="folder-header" onclick="toggleFolder(this)">
                        <i class="fas fa-chevron-down arrow-icon"></i>
                        <i class="fas fa-folder-open folder-icon u-text-rose"></i>
                        <span>infos_perso</span>
                    </div>

                    <div class="folder-children">
                        <div class="folder is-open">
                            <div class="folder-header" onclick="toggleFolder(this)">
                                <i class="fas fa-chevron-down arrow-icon"></i>
                                <i class="fas fa-folder folder-icon u-text-rose"></i>
                                <span>bio</span>
                            </div>
                            <div class="folder-children">
                                <div class="file active" onclick="openFile('biography', this)" data-file-id="biography" data-file-label="biographie.txt" data-image="bio-image">
                                    <i class="fas fa-file-alt file-icon u-text-secondary"></i>
                                    <span>biographie.txt</span>
                                </div>
                            </div>
                        </div>

                        <div class="folder">
                            <div class="folder-header" onclick="toggleFolder(this)">
                                <i class="fas fa-chevron-down arrow-icon"></i>
                                <i class="fas fa-folder-open folder-icon u-text-turquoise"></i>
                                <span>interests</span>
                            </div>
                            <div class="folder-children">
                                <div class="file" onclick="openFile('passions', this)" data-file-id="passions" data-file-label="mes_passions.md" data-image="passions-image">
                                    <i class="fas fa-file-alt file-icon u-text-secondary"></i>
                                    <span>mes_passions.md</span>
                                </div>
                            </div>
                        </div>

                        <div class="folder">
                            <div class="folder-header" onclick="toggleFolder(this)">
                                <i class="fas fa-chevron-down arrow-icon"></i>
                                <i class="fas fa-folder-open folder-icon u-text-blue"></i>
                                <span>Education</span>
                            </div>
                            <div class="folder-children">
                                <div class="file" onclick="openFile('diplomas', this)" data-file-id="diplomas" data-file-label="mes_diplomes.json" data-image="education-image">
                                    <i class="fas fa-graduation-cap file-icon u-text-secondary"></i>
                                    <span>mes_diplomes.json</span>
                                </div>
                                <div class="file" onclick="openFile('cv', this)" data-file-id="cv" data-file-label="mon_cv.pdf" data-image="cv-image">
                                    <i class="fas fa-file-pdf file-icon u-text-secondary"></i>
                                    <span>mon_cv.pdf</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="folder is-open folder-spaced">
                    <div class="folder-header" onclick="toggleFolder(this)">
                        <i class="fas fa-chevron-down arrow-icon"></i>
                        <i class="fas fa-folder folder-icon u-text-purple"></i>
                        <span>contacts</span>
                    </div>
                    <div class="folder-children">
                        <div class="contact-item">
                            <i class="fas fa-envelope u-text-secondary"></i>
                            <a href="mailto:<?= escape($contactEmail) ?>" class="selectable"><?= escape($contactEmail) ?></a>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone u-text-secondary"></i>
                            <a href="tel:<?= escape($contactPhone) ?>" class="selectable"><?= escape($contactPhone) ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="ide-editor">
            <div class="editor-tabs">
                <div class="tab active-tab" id="active-tab-label">
                    <span>biographie.txt</span>
                    <span class="close-tab">×</span>
                </div>
            </div>

            <div class="code-container">
                <div class="code-content">
                    <div id="content-biography" class="content-block active">
<pre>
<span class="comment">/**
<?= escape($aboutBio) ?>
 */</span>

<span class="keyword">const</span> <span class="variable">profile</span> = {
    <span class="property">name</span>: <span class="string">"Robin Hourtané"</span>,
    <span class="property">role</span>: <span class="string">"Full Stack Developer"</span>,
    <span class="property">age</span>: <span class="string">"23 ans"</span>,
    <span class="property">location</span>: <span class="string">"France"</span>
};
</pre>
                    </div>

                    <div id="content-passions" class="content-block">
<pre>
<span class="comment">// Mes centres d'intérêt</span>
<span class="keyword">class</span> <span class="class-name">Passions</span> {
    <span class="function">constructor</span>() {
        <span class="keyword">this</span>.<span class="property">hobbies</span> = [
            <span class="string">"Développement web"</span>,
            <span class="string">"Sports: [Sports de combat, Musculation, Randonnée]"</span>,
            <span class="string">"Musique"</span>,
            <span class="string">"Cuisine"</span>,
        ];
    }
}
</pre>
                    </div>

                    <div id="content-diplomas" class="content-block">
<pre>
[
    {
        <span class="key">"degree"</span>: <span class="string">"BUT MMI"</span>,
        <span class="key">"year"</span>: <span class="number">Processing...</span>
    },
    {
        <span class="key">"degree"</span>: <span class="string">"BAC STI2D"</span>,
        <span class="key">"year"</span>: <span class="number">2020</span>
    }
]
</pre>
                    </div>

                    <div id="content-cv" class="content-block">
<pre>
<span class="comment">// Téléchargement du CV...</span>
<span class="function">downloadCV</span>();
</pre>
                        <br>
                        <a href="<?= assetUrl('assets/files/CV_HOURTANE.pdf') ?>" class="btn-download" download>Télécharger le CV (.pdf)</a>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <section class="visual-column">
        <div class="image-wrapper">
            <img id="bio-image" src="<?= assetUrl('uploads/image.png') ?>" class="active-image" alt="Bio">
            <img id="passions-image" src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80" alt="Passions">
            <img id="education-image" src="<?= assetUrl('uploads/diplome.jpg') ?>" alt="Education">
            <img id="cv-image" src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?auto=format&fit=crop&w=800&q=80" alt="CV">
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const aboutFiles = Array.from(document.querySelectorAll('.file[data-file-id]'));
    const aboutMobileSelect = document.querySelector('[data-mobile-about-select]');
    const tabLabel = document.querySelector('#active-tab-label span');
    const contentBlocks = document.querySelectorAll('.content-block');
    const galleryImages = document.querySelectorAll('.image-wrapper img');

    const setupMobileSelectUi = (select) => {
        if (!select) {
            return { update: () => {} };
        }

        const shell = select.closest('[data-mobile-select-shell]');
        const groupLabel = shell?.querySelector('[data-mobile-select-group]');
        const valueLabel = shell?.querySelector('[data-mobile-select-value]');
        const icon = shell?.querySelector('[data-mobile-select-icon] i');

        const update = () => {
            const selectedOption = select.options[select.selectedIndex];
            if (!selectedOption || !shell) {
                return;
            }

            if (groupLabel) {
                groupLabel.textContent = selectedOption.dataset.group || selectedOption.parentElement?.label || 'navigation';
            }

            if (valueLabel) {
                valueLabel.textContent = selectedOption.textContent.trim();
            }

            if (icon) {
                icon.className = selectedOption.dataset.icon || 'fas fa-file-alt';
            }

            shell.dataset.accent = selectedOption.dataset.accent || 'blue';
        };

        update();

        return { update };
    };

    const aboutMobileSelectUi = setupMobileSelectUi(aboutMobileSelect);

    window.toggleFolder = function(headerElement) {
        const folder = headerElement.parentElement;
        folder.classList.toggle('is-open');
    };

    const syncAboutMobileSelect = (fileId) => {
        if (aboutMobileSelect) {
            aboutMobileSelect.value = fileId;
            aboutMobileSelectUi.update();
        }
    };

    window.openFile = function(fileId, element = null) {
        const activeFile = element || aboutFiles.find((file) => file.dataset.fileId === fileId);
        if (!activeFile) {
            return;
        }

        aboutFiles.forEach((file) => file.classList.remove('active'));
        activeFile.classList.add('active');
        contentBlocks.forEach((block) => block.classList.remove('active'));

        const contentId = 'content-' + fileId;
        const contentEl = document.getElementById(contentId);
        if (contentEl) {
            contentEl.classList.add('active');
        }

        if (tabLabel) {
            tabLabel.innerText = activeFile.dataset.fileLabel || activeFile.querySelector('span').innerText;
        }

        const imageId = activeFile.getAttribute('data-image');
        galleryImages.forEach(img => {
            img.classList.remove('active-image');
            setTimeout(() => {
                if (!img.classList.contains('active-image')) {
                    img.style.display = 'none';
                }
            }, 300);
        });

        const newImage = document.getElementById(imageId);
        if (newImage) {
            newImage.style.display = 'block';
            void newImage.offsetWidth;
            newImage.classList.add('active-image');
        }

        syncAboutMobileSelect(fileId);
    };

    if (aboutMobileSelect) {
        aboutMobileSelect.addEventListener('change', (event) => {
            window.openFile(event.target.value);
        });
    }

    const defaultFile = aboutFiles.find((file) => file.classList.contains('active'));
    if (defaultFile) {
        syncAboutMobileSelect(defaultFile.dataset.fileId);
    }
});
</script>
