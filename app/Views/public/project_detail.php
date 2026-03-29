<div class="projects-layout">
    <aside class="sidebar">
        <div class="sidebar-title">
            <i class="fas fa-project-diagram"></i> Explorer
        </div>
        <div class="filter-group">
            <a href="<?= siteUrl('projects.php') ?>" class="filter-item project-sidebar-link">
                <i class="fas fa-arrow-left"></i> .. (retour)
            </a>
            <div class="filter-item project-sidebar-current">
                <i class="fas fa-file-code project-sidebar-current-icon"></i> <?= escape($project['title']) ?>.md
            </div>
            <?php if ($project['live_link']): ?>
                <a href="<?= escape($project['live_link']) ?>" target="_blank" class="filter-item project-sidebar-link">
                    <i class="fas fa-external-link-alt project-sidebar-current-icon"></i> visit_live_site()
                </a>
            <?php endif; ?>
        </div>
    </aside>

    <main class="main-content">
        <div class="file-tab-bar">
            <div class="file-tab active">
                <i class="fas fa-info-circle project-tab-icon"></i> <?= escape($project['title']) ?>.md
                <a href="<?= siteUrl('projects.php') ?>" class="close-tab">×</a>
            </div>
        </div>

        <div class="project-detail-container">
            <header class="project-header">
                <p class="path-breadcrumb">projects / <?= escape($project['category']) ?> / <?= escape($project['type']) ?> /</p>
                <h1><?= escape($project['title']) ?></h1>
                <h2 class="project-subtitle">> <?= escape($project['subtitle']) ?></h2>
            </header>

            <?php if (!empty($competences)): ?>
                <div class="tags-container">
                    <?php foreach ($competences as $tag): ?>
                        <span class="tag-badge">#<?= escape($tag) ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="carousel-container">
                <?php if ($project['image_url']): ?>
                    <img src="<?= siteUrl('uploads/projects/' . $project['image_url']) ?>" class="carousel-slide active" alt="Cover">
                <?php endif; ?>
                <?php foreach ($gallery as $img): ?>
                    <img src="<?= siteUrl('uploads/projects/' . $img['image_url']) ?>" class="carousel-slide" alt="Gallery">
                <?php endforeach; ?>
                <?php if (count($gallery) > 0): ?>
                    <button class="carousel-btn prev-btn" onclick="moveSlide(-1)">&#10094;</button>
                    <button class="carousel-btn next-btn" onclick="moveSlide(1)">&#10095;</button>
                <?php endif; ?>
            </div>

            <div class="code-snippet-box">
                <div class="line"><span class="keyword">const</span> <span class="var-name">projectConfig</span> = {</div>
                <div class="line indent"><span class="key">date:</span> <span class="string">"<?= date('Y-m-d', strtotime($project['created_at'])) ?>"</span>,</div>

                <?php if (!empty($softwares)): ?>
                    <div class="line indent"><span class="key">software:</span> [
                        <?php foreach ($softwares as $soft): ?><span class="string">"<?= escape($soft) ?>"</span>,<?php endforeach; ?>
                    ],</div>
                <?php endif; ?>

                <?php if (!empty($technologies)): ?>
                    <div class="line indent"><span class="key">stack:</span> [
                        <?php foreach ($technologies as $tech): ?><span class="string">"<?= escape($tech) ?>"</span>,<?php endforeach; ?>
                    ],</div>
                <?php endif; ?>

                <?php if (!empty($competences)): ?>
                    <div class="line indent"><span class="key">tags:</span> [
                        <?php foreach ($competences as $tag): ?><span class="string">"<?= escape($tag) ?>"</span>,<?php endforeach; ?>
                    ],</div>
                <?php endif; ?>

                <div class="line">};</div>
            </div>

            <div class="project-body">
                <h3>_description</h3>
                <div class="markdown-content"><?= nl2br(escape($project['description'])) ?></div>
            </div>

            <?php if ($project['live_link']): ?>
                <div class="live-link-box">
                    <h3 class="live-link-box-title">Le projet est en ligne ! 🚀</h3>
                    <p class="live-link-box-copy">Vous pouvez tester directement.</p>
                    <a href="<?= escape($project['live_link']) ?>" target="_blank" class="btn-primary live-link-box-action">
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
    if (slides.length <= 1) return;
    slides[slideIndex].classList.remove('active');
    slideIndex += n;
    if (slideIndex >= slides.length) slideIndex = 0;
    if (slideIndex < 0) slideIndex = slides.length - 1;
    slides[slideIndex].classList.add('active');
}
</script>
