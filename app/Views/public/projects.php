<style>
    .sidebar-content .file span {
        text-transform: lowercase;
    }
</style>

<div class="about-container">
    <aside class="ide-sidebar">
        <div class="sidebar-header">
            <span>EXPLORATEUR : PROJETS</span>
        </div>

        <div class="mobile-sidebar-panel">
            <label class="mobile-sidebar-label" for="projects-mobile-filter-select">navigation_mobile</label>
            <div class="mobile-sidebar-select-shell" data-mobile-select-shell data-accent="blue">
                <span class="mobile-sidebar-select-accent" aria-hidden="true"></span>
                <span class="mobile-sidebar-select-icon" data-mobile-select-icon aria-hidden="true">
                    <i class="fas fa-layer-group"></i>
                </span>
                <span class="mobile-sidebar-select-meta">
                    <span class="mobile-sidebar-select-group" data-mobile-select-group>filtres</span>
                    <span class="mobile-sidebar-select-value" data-mobile-select-value>tous_les_projets</span>
                </span>
                <span class="mobile-sidebar-select-caret" aria-hidden="true">
                    <i class="fas fa-chevron-down"></i>
                </span>

                <select id="projects-mobile-filter-select" class="mobile-sidebar-select" data-mobile-projects-select>
                    <option value="__all__" data-group="filtres" data-icon="fas fa-layer-group" data-accent="blue">tous_les_projets</option>
                    <option value="__multiple__" data-group="filtres" data-icon="fas fa-sliders-h" data-accent="purple">selection_multiple</option>
                    <optgroup label="filtres / par_categorie">
                        <option value="category-pro" data-type="category" data-value="pro" data-group="filtres / par_categorie" data-icon="fas fa-briefcase" data-accent="turquoise">professionnel</option>
                        <option value="category-university" data-type="category" data-value="university" data-group="filtres / par_categorie" data-icon="fas fa-graduation-cap" data-accent="blue">universitaire</option>
                    </optgroup>
                    <optgroup label="filtres / par_competence">
                        <?php foreach ($projectTags as $tag): ?>
                            <option value="competence-<?= escape(md5($tag)) ?>" data-type="competence" data-value="<?= escape($tag) ?>" data-group="filtres / par_competence" data-icon="fas fa-tag" data-accent="rose">
                                <?= escape($tag) ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    <optgroup label="filtres / par_stack">
                        <option value="type-web-dev" data-type="type" data-value="web_dev" data-group="filtres / par_stack" data-icon="fab fa-js" data-accent="rose">web_dev.ts</option>
                        <option value="type-communication" data-type="type" data-value="communication" data-group="filtres / par_stack" data-icon="fas fa-bullhorn" data-accent="purple">com.md</option>
                        <option value="type-digital-creation" data-type="type" data-value="digital_creation" data-group="filtres / par_stack" data-icon="fas fa-paint-brush" data-accent="turquoise">design.css</option>
                    </optgroup>
                </select>
            </div>
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
                            <?php foreach ($projectTags as $tag): ?>
                                <div class="file" data-type="competence" data-value="<?= escape($tag) ?>" onclick="toggleFilter(this)">
                                    <i class="fas fa-tag file-icon" style="color: var(--accent-rose);"></i>
                                    <span><?= escape($tag) ?></span>
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
                <div class="project-card" data-category="<?= escape($project['category']) ?>" data-type="<?= escape($project['type']) ?>" data-competences="<?= escape($project['competences']) ?>">
                    <div style="height: 180px; overflow: hidden; background: #000; position:relative; border-bottom: 1px solid var(--border);">
                        <?php if ($project['image_url']): ?>
                            <img src="<?= siteUrl('uploads/projects/' . $project['image_url']) ?>" alt="<?= escape($project['title']) ?>" class="project-thumb">
                        <?php else: ?>
                            <div style="height:100%; display:flex; align-items:center; justify-content:center; background:var(--bg-dark); color:var(--text-secondary);">No Image</div>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <h3 class="card-title"><?= escape($project['title']) ?></h3>
                        <p class="card-subtitle">// <?= escape($project['subtitle']) ?></p>

                        <?php if (!empty($project['software'])): ?>
                            <p style="color: var(--text-secondary); font-size: 0.8rem; margin-top: -0.5rem; margin-bottom: 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <i class="fas fa-layer-group" style="margin-right: 5px;"></i> <?= escape($project['software']) ?>
                            </p>
                        <?php endif; ?>

                        <?php $cardTags = !empty($project['competences']) ? explode(',', $project['competences']) : []; ?>
                        <?php if (!empty($cardTags)): ?>
                            <div style="margin-bottom: 10px; display:flex; flex-wrap:wrap; gap:5px;">
                                <?php foreach ($cardTags as $tag): ?>
                                    <span style="font-size: 0.7rem; color: var(--accent-blue); background: rgba(77,91,206,0.1); padding: 2px 5px; border-radius: 3px;">#<?= escape($tag) ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="card-desc">
                            <?= substr(escape($project['description']), 0, 100) ?>...
                        </div>

                        <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center;">
                            <a href="<?= siteUrl('project-detail.php?id=' . $project['id']) ?>" class="btn">Voir_projet</a>
                            <div style="display:flex; gap:10px; align-items:center;">
                                <?php if ($project['live_link']): ?>
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

            <?php if (empty($projects)): ?>
                <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">Aucun projet trouvé.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const projectFilterItems = Array.from(document.querySelectorAll('.file[data-type][data-value]'));
    const mobileProjectsSelect = document.querySelector('[data-mobile-projects-select]');

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
                icon.className = selectedOption.dataset.icon || 'fas fa-layer-group';
            }

            shell.dataset.accent = selectedOption.dataset.accent || 'blue';
        };

        update();

        return { update };
    };

    const projectsMobileSelectUi = setupMobileSelectUi(mobileProjectsSelect);

    window.toggleFolder = function(headerElement) {
        const folder = headerElement.parentElement;
        folder.classList.toggle('is-open');
    };

    window.toggleFilter = function(element) {
        element.classList.toggle('active');
        applyFilters();
    };

    function syncProjectsMobileSelect() {
        if (!mobileProjectsSelect) {
            return;
        }

        const activeItems = projectFilterItems.filter((item) => item.classList.contains('active'));
        if (activeItems.length === 0) {
            mobileProjectsSelect.value = '__all__';
            projectsMobileSelectUi.update();
            return;
        }

        if (activeItems.length === 1) {
            const matchingOption = Array.from(mobileProjectsSelect.options).find((option) =>
                option.dataset.type === activeItems[0].dataset.type &&
                option.dataset.value === activeItems[0].dataset.value
            );

            if (matchingOption) {
                mobileProjectsSelect.value = matchingOption.value;
                projectsMobileSelectUi.update();
                return;
            }
        }

        mobileProjectsSelect.value = '__multiple__';
        projectsMobileSelectUi.update();
    }

    function applyFilters() {
        const activeFilters = { category: [], type: [], competence: [] };

        projectFilterItems
            .filter((item) => item.classList.contains('active'))
            .forEach((el) => {
            const type = el.dataset.type;
            const val = el.dataset.value;
            if (type === 'category') activeFilters.category.push(val);
            if (type === 'type') activeFilters.type.push(val);
            if (type === 'competence') activeFilters.competence.push(val);
        });

        const display = document.getElementById('active-filters-display');
        const allFilters = [...activeFilters.category, ...activeFilters.type, ...activeFilters.competence];
        display.innerText = allFilters.length > 0 ? allFilters.join('; ') : 'Tous';

        document.querySelectorAll('.project-card').forEach(card => {
            const cCat = card.dataset.category;
            const cType = card.dataset.type;
            const cComps = card.dataset.competences ? card.dataset.competences.split(',') : [];
            const catMatch = activeFilters.category.length === 0 || activeFilters.category.includes(cCat);
            const typeMatch = activeFilters.type.length === 0 || activeFilters.type.includes(cType);
            let compMatch = activeFilters.competence.length === 0;
            if (!compMatch) compMatch = cComps.some(r => activeFilters.competence.includes(r));

            if (catMatch && typeMatch && compMatch) {
                card.style.display = 'flex';
                setTimeout(() => card.style.opacity = '1', 10);
            } else {
                card.style.opacity = '0';
                setTimeout(() => card.style.display = 'none', 300);
            }
        });

        syncProjectsMobileSelect();
    }

    if (mobileProjectsSelect) {
        mobileProjectsSelect.addEventListener('change', (event) => {
            const selectedOption = event.target.options[event.target.selectedIndex];

            if (selectedOption.value === '__multiple__') {
                syncProjectsMobileSelect();
                return;
            }

            projectFilterItems.forEach((item) => item.classList.remove('active'));

            if (selectedOption.dataset.type && selectedOption.dataset.value) {
                const targetItem = projectFilterItems.find((item) =>
                    item.dataset.type === selectedOption.dataset.type &&
                    item.dataset.value === selectedOption.dataset.value
                );

                if (targetItem) {
                    targetItem.classList.add('active');
                }
            }

            applyFilters();
        });
    }

    applyFilters();
});
</script>
