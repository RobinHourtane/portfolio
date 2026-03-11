<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = "À propos";
require_once 'includes/header.php';
?>

<div class="about-container">

    <section class="ide-column">
        
        <aside class="ide-sidebar">
            <div class="sidebar-header">
                <span>EXPLORATEUR</span>
            </div>
            
            <div class="sidebar-content">
                <div class="folder is-open">
                    <div class="folder-header" onclick="toggleFolder(this)">
                        <i class="fas fa-chevron-down arrow-icon"></i>
                        <i class="fas fa-folder-open folder-icon" style="color: #E99287;"></i>
                        <span>infos_perso</span>
                    </div>
                    
                    <div class="folder-children">
                        
                        <div class="folder is-open">
                            <div class="folder-header" onclick="toggleFolder(this)">
                                <i class="fas fa-chevron-down arrow-icon"></i>
                                <i class="fas fa-folder folder-icon" style="color: #E99287;"></i>
                                <span>bio</span>
                            </div>
                            <div class="folder-children">
                                <div class="file active" onclick="openFile('biography', this)" data-image="bio-image">
                                    <i class="fas fa-file-alt file-icon" style="color: #607B96;"></i>
                                    <span>biographie.txt</span>
                                </div>
                            </div>
                        </div>

                        <div class="folder">
                    <div class="folder-header" onclick="toggleFolder(this)">
                        <i class="fas fa-chevron-down arrow-icon"></i>
                        <i class="fas fa-folder-open folder-icon" style="color: #43D9AD;"></i>
                                <span>interests</span>
                            </div>
                            <div class="folder-children">
                                <div class="file" onclick="openFile('passions', this)" data-image="passions-image">
                                    <i class="fas fa-file-alt file-icon" style="color: #607B96;"></i>
                                    <span>mes_passions.md</span>
                                </div>
                            </div>
                        </div>

                        <div class="folder">
                            <div class="folder-header" onclick="toggleFolder(this)">
                        <i class="fas fa-chevron-down arrow-icon"></i>
                        <i class="fas fa-folder-open folder-icon" style="color: #4D5BCE;"></i>
                                <span>education</span>
                            </div>
                            <div class="folder-children">
                                <div class="file" onclick="openFile('diplomas', this)" data-image="education-image">
                                    <i class="fas fa-graduation-cap file-icon" style="color: #607B96;"></i>
                                    <span>mes_diplomes.json</span>
                                </div>
                                <div class="file" onclick="openFile('cv', this)" data-image="cv-image">
                                    <i class="fas fa-file-pdf file-icon" style="color: #607B96;"></i>
                                    <span>mon_cv.pdf</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="folder is-open" style="margin-top: 10px;">
                    <div class="folder-header" onclick="toggleFolder(this)">
                        <i class="fas fa-chevron-down arrow-icon"></i>
                        <i class="fas fa-folder folder-icon" style="color: #C98BDF;"></i>
                        <span>contacts</span>
                    </div>
                    <div class="folder-children">
                        <div class="contact-item">
                            <i class="fas fa-envelope" style="color: #607B96;"></i>
                            <a href="mailto:robin.hourtane@gmail.com" class="selectable">robin.hourtane@gmail.com</a>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone" style="color: #607B96;"></i>
                            <a href="tel:+33610105558" class="selectable">+33610105558</a>
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
Passionné par le design graphique, le développement web et la communication digitale, je m'appelle Robin Hourtané, étudiant en BUT MMI à l’IUT de Toulon. Curieux, rigoureux et créatif, j'aime concevoir des expériences web soignées, à la fois visuelles et fonctionnelles. Mes compétences vont de l’UI/UX au développement PHP en passant par la gestion de projets.
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
                        <a href="assets/files/CV_HOURTANE.pdf" class="btn-download" download>Télécharger le CV (.pdf)</a>
                    </div>

                </div>
            </div>
        </main>
    </section>

    <section class="visual-column">
        <div class="image-wrapper">
            <img id="bio-image" src="uploads/image.png" class="active-image" alt="Bio">
            <img id="passions-image" src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80" alt="Passions">
            <img id="education-image" src="uploads/diplome.jpg" alt="Education">
            <img id="cv-image" src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?auto=format&fit=crop&w=800&q=80" alt="CV">
        </div>
        
    </section>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. Gestion des Dossiers (Ouverture/Fermeture) ---
    window.toggleFolder = function(headerElement) {
        const folder = headerElement.parentElement;
        folder.classList.toggle('is-open');
    };

    // --- 2. Gestion de l'ouverture des Fichiers ---
    window.openFile = function(fileId, element) {
        
        // A. Mise à jour de la Sidebar (Classe active)
        document.querySelectorAll('.file').forEach(el => el.classList.remove('active'));
        element.classList.add('active');

        // B. Mise à jour du Contenu Texte
        document.querySelectorAll('.content-block').forEach(el => el.classList.remove('active'));
        const contentId = 'content-' + fileId;
        const contentEl = document.getElementById(contentId);
        if(contentEl) {
            contentEl.classList.add('active');
        } else {
            console.error("Contenu introuvable pour l'ID : " + contentId);
        }

        // C. Mise à jour de l'Onglet (Nom du fichier)
        const fileName = element.querySelector('span').innerText;
        const tabLabel = document.querySelector('#active-tab-label span');
        if(tabLabel) tabLabel.innerText = fileName;

        // D. Mise à jour de l'Image
        const imageId = element.getAttribute('data-image');
        
        document.querySelectorAll('.image-wrapper img').forEach(img => {
            img.classList.remove('active-image');
            setTimeout(() => {
                if(!img.classList.contains('active-image')) img.style.display = 'none';
            }, 300);
        });

        const newImage = document.getElementById(imageId);
        if(newImage) {
            newImage.style.display = 'block';
            void newImage.offsetWidth; 
            newImage.classList.add('active-image');
        } else {
            console.error("Image introuvable pour l'ID : " + imageId);
        }
    };

});
</script>

<?php require_once 'includes/footer.php'; ?>