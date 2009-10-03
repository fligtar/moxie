<a href="<?php echo $this->getBaseURL().'/'.$vars['product']['url'].'/roadmap/upcoming'; ?>">upcoming year</a>
<a href="<?php echo $this->getBaseURL().'/'.$vars['product']['url'].'/roadmap/year'; ?>">current year</a>

<div class="roadmap">
    <div class="start-row">
        <div></div>
        <div class="start" style="height: <?php echo $vars['elapsed'] * 3; ?>em;"></div>
        <div></div>
    </div>
    <?php
    foreach ($vars['quarters'] as $k => $quarter):
    ?>
    <div class="quarter<?php if ($k == 0) echo ' first'; if ($quarter['active']) echo ' active'; ?>">
        <div class="quarter-label">
            <span>Q<?php echo $quarter['quarter']; ?></span><?php echo $quarter['year']; ?>
        </div>
        <div class="months">
            <ul>
                <li><span><?php echo date('F', mktime(0, 0, 0, ($quarter['quarter'] - 1) * 3 + 1)); ?></span></li>
                <li><span><?php echo date('F', mktime(0, 0, 0, ($quarter['quarter'] - 1) * 3 + 2)); ?></span></li>
                <li><span><?php echo date('F', mktime(0, 0, 0, ($quarter['quarter'] - 1) * 3 + 3)); ?></span></li>
            </ul>
        </div>
        <div class="items">
            <ul>
            <?php
            if (!empty($quarter['items'])) {
                foreach ($quarter['items'] as $milestone) {
                    echo '<li><a href="'.$this->getBaseURL().'/'.$vars['product']['url'].'/milestones/'.$milestone['url'].'">'.$milestone['name'].'</a></li>';
                }
            }
            ?>
            </ul>
        </div>
    </div>
    <?php
    endforeach;
    ?>
    <div class="end-row">
        <div></div>
        <div class="end"></div>
        <div></div>
    </div>
</div>