<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!hasDatabase()) redirect('projects.php');
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) redirect('projects.php');
$id = $_GET['id'];

// Récupération du projet
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND is_published = 1");
$stmt->execute([$id]);
$project = $stmt->fetch();

if (!$project) redirect('projects.php');

// Galerie
$stmtImg = $pdo->prepare("SELECT * FROM project_images WHERE project_id = ?");
$stmtImg->execute([$id]);
$gallery = $stmtImg->fetchAll();

$pageTitle = $project['title'];

// --- TRAITEMENT DES DONNÉES ---

// 1. Logiciels (Nouveau champ ajouté précédemment)
$softwares = !empty($project['software']) ? array_map('trim', explode(',', $project['software'])) : [];

// 2. Compétences (Tags)
$competences = !empty($project['competences']) ? array_map('trim', explode(',', $project['competences'])) : [];

// 3. Stack (Basé sur le TYPE comme demandé)
// On transforme le code 'web_dev' en joli texte pour l'affichage
$typeLabels = [
    'web_dev' => 'Développement Web',
    'communication' => 'Communication',
    'digital_creation' => 'Création Numérique',
    'pro' => 'Professionnel',       // Cas où le type serait une catégorie
    'university' => 'Universitaire' // Cas où le type serait une catégorie
];

// On récupère le type brut de la BDD (ex: 'web_dev')
$rawType = $project['type']; 
// On cherche le joli nom, sinon on affiche le brut
$displayType = isset($typeLabels[$rawType]) ? $typeLabels[$rawType] : $rawType;

// On met ça dans un tableau pour que la boucle foreach de l'affichage fonctionne
$technologies = [$displayType];

require_once 'includes/header.php';
?>

<style>
    .carousel-container { position: relative; width: 100%; border: 1px solid var(--border); border-radius: 8px; overflow: hidden; margin-bottom: 2rem; background: #000; }
    .carousel-slide { display: none; width: 100%; height: auto; max-height: 500px; object-fit: contain; }
    .carousel-slide.active { display: block; }
    .carousel-btn { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: white; border: none; padding: 10px 15px; cursor: pointer; font-size: 1.5rem; transition: background 0.3s; z-index: 10; }
    .carousel-btn:hover { background: var(--accent-blue); }
    .prev-btn { left: 0; }
    .next-btn { right: 0; }
    
    .tags-container { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 1.5rem; }
    .tag-badge { font-family: var(--font-code); font-size: 0.8rem; padding: 4px 8px; border-radius: 4px; background: rgba(77, 91, 206, 0.1); color: var(--accent-blue); border: 1px solid var(--accent-blue); }
    
    .live-link-box { margin-top: 2rem; padding: 1.5rem; background: rgba(67, 217, 173, 0.05); border: 1px dashed var(--accent-turquoise); border-radius: 8px; text-align: center; }
</style>

<div class="projects-layout">
    
    <aside class="sidebar">
        <div class="sidebar-title">
            <i class="fas fa-project-diagram"></i> Explorer
        </div>
        <div class="filter-group">
            <a href="projects.php" class="filter-item" style="text-decoration:none; color:var(--text-secondary);">
                <i class="fas fa-arrow-left"></i> .. (retour)
            </a>
            <div class="filter-item" style="color: var(--text-main); background: rgba(255,255,255,0.05);">
                <i class="fas fa-file-code" style="color: var(--accent-turquoise);"></i> <?= escape($project['title']) ?>.md
            </div>
            
            <?php if($project['live_link']): ?>
            <a href="<?= escape($project['live_link']) ?>" target="_blank" class="filter-item" style="text-decoration:none; color:var(--text-secondary);">
                <i class="fas fa-external-link-alt" style="color: var(--accent-turquoise);"></i> visit_live_site()
            </a>
            <?php endif; ?>
        </div>
    </aside>

    <main class="main-content">
        <div class="file-tab-bar">
            <div class="file-tab active">
                <i class="fas fa-info-circle" style="color: var(--accent-blue);"></i> <?= escape($project['title']) ?>.md
                <a href="projects.php" class="close-tab">×</a>
            </div>
        </div>

        <div class="project-detail-container">
            <header class="project-header">
                <p class="path-breadcrumb">projects / <?= escape($project['category']) ?> / <?= escape($project['type']) ?> /</p>
                <h1><?= escape($project['title']) ?></h1>
                <h2 class="project-subtitle">> <?= escape($project['subtitle']) ?></h2>
            </header>

            <?php if(!empty($competences)): ?>
                <div class="tags-container">
                    <?php foreach($competences as $tag): ?>
                        <span class="tag-badge">#<?= escape($tag) ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="carousel-container">
                <?php if($project['image_url']): ?>
                    <img src="uploads/projects/<?= escape($project['image_url']) ?>" class="carousel-slide active" alt="Cover">
                <?php endif; ?>
                
                <?php foreach($gallery as $img): ?>
                    <img src="uploads/projects/<?= escape($img['image_url']) ?>" class="carousel-slide" alt="Gallery">
                <?php endforeach; ?>

                <?php if(count($gallery) > 0): ?>
                    <button class="carousel-btn prev-btn" onclick="moveSlide(-1)">&#10094;</button>
                    <button class="carousel-btn next-btn" onclick="moveSlide(1)">&#10095;</button>
                <?php endif; ?>
            </div>

            <div class="code-snippet-box">
                <div class="line"><span class="keyword">const</span> <span class="var-name">projectConfig</span> = {</div>
                <div class="line indent">
                    <span class="key">date:</span> <span class="string">"<?= date('Y-m-d', strtotime($project['created_at'])) ?>"</span>,
                </div>
                
                <?php if(!empty($softwares)): ?>
                <div class="line indent">
                    <span class="key">software:</span> [
                    <?php foreach($softwares as $soft): ?>
                        <span class="string">"<?= escape($soft) ?>"</span>,
                    <?php endforeach; ?>
                    ],
                </div>
                <?php endif; ?>
                
                <?php if(!empty($technologies)): ?>
                <div class="line indent">
                    <span class="key">stack:</span> [
                    <?php foreach($technologies as $tech): ?>
                        <span class="string">"<?= escape($tech) ?>"</span>,
                    <?php endforeach; ?>
                    ],
                </div>
                <?php endif; ?>
                
                <?php if(!empty($competences)): ?>
                <div class="line indent">
                    <span class="key">tags:</span> [
                    <?php foreach($competences as $tag): ?>
                        <span class="string">"<?= escape($tag) ?>"</span>,
                    <?php endforeach; ?>
                    ],
                </div>
                <?php endif; ?>
                
                <div class="line">};</div>
            </div>

            <div class="project-body">
                <h3>_description</h3>
                <div class="markdown-content">
                    <?= nl2br(escape($project['description'])) ?>
                </div>
            </div>

            <?php if($project['live_link']): ?>
                <div class="live-link-box">
                    <h3 style="color: var(--accent-turquoise); margin-bottom: 10px;">Le projet est en ligne ! 🚀</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 1rem;">Vous pouvez tester directement.</p>
                    <a href="<?= escape($project['live_link']) ?>" target="_blank" class="btn-primary" style="padding: 10px 25px; font-size: 1.1rem;">
                        <i></i> Accéder au projet
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </main>
</div>

<script>
    let slideIndex = 0;
    const slides = document.querySelectorAll('.carousel-slide');

    function moveSlide(n) {
        if(slides.length <= 1) return;
        slides[slideIndex].classList.remove('active');
        slideIndex += n;
        if (slideIndex >= slides.length) slideIndex = 0;
        if (slideIndex < 0) slideIndex = slides.length - 1;
        slides[slideIndex].classList.add('active');
    }
</script>

<?php require_once 'includes/footer.php'; ?>
