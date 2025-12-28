<?php
// Variabel yang WAJIB tersedia:
// $user
// $pageTitle
?>

<div class="header">
    <h2 class="page-title">
        <?= htmlspecialchars($pageTitle ?? '') ?>
    </h2>

    <div class="user-info">
        <span class="username">
            <?= htmlspecialchars($user['nama']) ?>
        </span>

        <?php if (!empty($user['foto'])): ?>
            <img src="../assets/uploads/profile/<?= htmlspecialchars($user['foto']) ?>"
                 class="user-avatar-img"
                 alt="Avatar">
        <?php else: ?>
            <div class="user-avatar">
                <?= strtoupper(substr($user['nama'], 0, 1)) ?>
            </div>
        <?php endif; ?>
    </div>
</div>
