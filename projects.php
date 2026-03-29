<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = "_projets";

// Récupération des projets publiés
$projects = [];
if (hasDatabase()) {
    $stmt = $pdo->query("SELECT * FROM projects WHERE is_published = 1 ORDER BY order_position ASC, created_at DESC");
    $projects = $stmt->fetchAll();
}

require_once 'includes/header.php';
?>

<style>
    .sidebar-content .file span {
        text-transform: lowercase; /* Gère parfaitement "Développer" -> "développer" */
    }
</style>

<div class="about-container">
    
    <aside class="ide-sidebar">
        <div class="sidebar-header">
            <span>EXPLORATEUR : PROJETS</span>
        </div>
        
        <div class="sidebar-content">
            <div class="folder">
                <div class="folder-header" onclick="toggleFolder(this)">
                    <i class="fas fa-chevron-down arrow-icon"></i>
                    <i class="fas fa-folder-open folder-icon" style="color: #E99287;"></i>
                    <span>filtres</span>
                </div>
                
                <div class="folder-children">
                    
                    <div class="folder">
                        <div class="folder-header" onclick="toggleFolder(this)">
                            <i class="fas fa-chevron-down arrow-icon"></i>
                            <i class="fas fa-folder folder-icon" style="color: #43D9AD;"></i>
                            <span>par_categorie</span>
                        </div>
                        <div class="folder-children">
                            <div class="file" data-type="category" data-value="pro" onclick="toggleFilter(this)">
                                <i class="fas fa-briefcase file-icon" style="color: #607B96;"></i>
                                <span>professionnel</span>
                            </div>
                            <div class="file" data-type="category" data-value="university" onclick="toggleFilter(this)">
                                <i class="fas fa-graduation-cap file-icon" style="color: #607B96;"></i>
                                <span>universitaire</span>
                            </div>
                        </div>
                    </div>

                    <div class="folder">
                        <div class="folder-header" onclick="toggleFolder(this)">
                            <i class="fas fa-chevron-down arrow-icon"></i>
                            <i class="fas fa-folder folder-icon" style="color: #E99287;"></i>
                            <span>par_competence</span>
                        </div>
                        <div class="folder-children">
                            <?php 
                            $tags = ["Comprendre", "Exprimer", "Concevoir", "Développer", "Entreprendre"];
                            foreach($tags as $tag): 
                            ?>
                            <div class="file" data-type="competence" data-value="<?= $tag ?>" onclick="toggleFilter(this)">
                                <i class="fas fa-tag file-icon" style="color: var(--accent-rose);"></i>
                                <span><?= $tag ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="folder">
                        <div class="folder-header" onclick="toggleFolder(this)">
                            <i class="fas fa-chevron-down arrow-icon"></i>
                            <i class="fas fa-folder folder-icon" style="color: #4D5BCE;"></i>
                            <span>par_stack</span>
                        </div>
                        <div class="folder-children">
                            <div class="file" data-type="type" data-value="web_dev" onclick="toggleFilter(this)">
                                <i class="fab fa-js file-icon" style="color: #E99287;"></i>
                                <span>web_dev.ts</span>
                            </div>
                            <div class="file" data-type="type" data-value="communication" onclick="toggleFilter(this)">
                                <i class="fas fa-bullhorn file-icon" style="color: #C98BDF;"></i>
                                <span>com.md</span>
                            </div>
                            <div class="file" data-type="type" data-value="digital_creation" onclick="toggleFilter(this)">
                                <i class="fas fa-paint-brush file-icon" style="color: #43D9AD;"></i>
                                <span>design.css</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </aside>

    <main class="ide-editor" style="background-color: var(--bg-darker);">
        
        <div class="editor-tabs">
            <div class="tab" style="border-top: none; cursor: default;">
                <span style="color: var(--text-secondary); font-size: 0.8rem;">filtres_actifs : </span>
                <span id="active-filters-display" style="color: var(--accent-turquoise); margin-left: 10px;">Tous</span>
            </div>
        </div>

        <div class="projects-grid" style="padding: 2rem; overflow-y: auto; height: 100%;">
            <?php foreach ($projects as $project): ?>
                <div class="project-card" 
                     data-category="<?= escape($project['category']) ?>" 
                     data-type="<?= escape($project['type']) ?>"
                     data-competences="<?= escape($project['competences']) ?>">
                    
                    <div style="height: 180px; overflow: hidden; background: #000; position:relative; border-bottom: 1px solid var(--border);">
                        <?php if($project['image_url']): ?>
                            <img src="uploads/projects/<?= escape($project['image_url']) ?>" alt="<?= escape($project['title']) ?>" class="project-thumb">
                        <?php else: ?>
                            <div style="height:100%; display:flex; align-items:center; justify-content:center; background:var(--bg-dark); color:var(--text-secondary);">No Image</div>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <h3 class="card-title"><?= escape($project['title']) ?></h3>
                        <p class="card-subtitle">// <?= escape($project['subtitle']) ?></p>
                        
                        <?php if(!empty($project['software'])): ?>
                            <p style="color: var(--text-secondary); font-size: 0.8rem; margin-top: -0.5rem; margin-bottom: 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <i class="fas fa-layer-group" style="margin-right: 5px;"></i> <?= escape($project['software']) ?>
                            </p>
                        <?php endif; ?>

                        <?php 
                        $cardTags = !empty($project['competences']) ? explode(',', $project['competences']) : [];
                        if(!empty($cardTags)): 
                        ?>
                        <div style="margin-bottom: 10px; display:flex; flex-wrap:wrap; gap:5px;">
                            <?php foreach($cardTags as $tag): ?>
                                <span style="font-size: 0.7rem; color: var(--accent-blue); background: rgba(77,91,206,0.1); padding: 2px 5px; border-radius: 3px;">#<?= $tag ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <div class="card-desc">
                            <?= substr(escape($project['description']), 0, 100) ?>...
                        </div>

                        <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center;">
                            <a href="project-detail.php?id=<?= $project['id'] ?>" class="btn">
                                Voir_projet
                            </a>
                            <div style="display:flex; gap:10px; align-items:center;">
                                <?php if($project['live_link']): ?>
                                    <a href="<?= escape($project['live_link']) ?>" target="_blank" title="Live" style="color: var(--text-secondary);">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                <?php endif; ?>
                                <i class="fas fa-code" style="color: var(--text-secondary);"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if(empty($projects)): ?>
                <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">Aucun projet trouvé.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Fonction Toggle Folder
    window.toggleFolder = function(headerElement) {
        const folder = headerElement.parentElement;
        folder.classList.toggle('is-open');
    };

    // 2. Fonction de Filtrage
    window.toggleFilter = function(element) {
        element.classList.toggle('active');
        applyFilters();
    };

    function applyFilters() {
        const activeFilters = { 
            category: [], 
            type: [], 
            competence: [] 
        };

        document.querySelectorAll('.file.active').forEach(el => {
            const type = el.dataset.type;
            const val = el.dataset.value;
            
            if (type === 'category') activeFilters.category.push(val);
            if (type === 'type') activeFilters.type.push(val);
            if (type === 'competence') activeFilters.competence.push(val);
        });

        const display = document.getElementById('active-filters-display');
        const allFilters = [...activeFilters.category, ...activeFilters.type, ...activeFilters.competence];
        display.innerText = allFilters.length > 0 ? allFilters.join('; ') : 'Tous';

        const cards = document.querySelectorAll('.project-card');
        cards.forEach(card => {
            const cCat = card.dataset.category;
            const cType = card.dataset.type;
            const cComps = card.dataset.competences ? card.dataset.competences.split(',') : [];

            const catMatch = activeFilters.category.length === 0 || activeFilters.category.includes(cCat);
            const typeMatch = activeFilters.type.length === 0 || activeFilters.type.includes(cType);
            
            let compMatch = activeFilters.competence.length === 0;
            if(!compMatch) {
                compMatch = cComps.some(r => activeFilters.competence.includes(r));
            }

            if (catMatch && typeMatch && compMatch) {
                card.style.display = 'flex';
                setTimeout(() => card.style.opacity = '1', 10);
            } else {
                card.style.opacity = '0';
                setTimeout(() => card.style.display = 'none', 300);
            }
        });
    }
    
    applyFilters();
});
</script>

<?php require_once 'includes/footer.php'; ?>
