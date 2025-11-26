<?php $this->layout('template', ['title' => 'Historique des actions']) ?>

<div class="logs-container">

    <h1 class="page-title">Historique des actions</h1>

    <?php if (empty($logs)): ?>

        <div class="message-box">
            Aucun log enregistré pour le moment.
        </div>

    <?php else: ?>

        <div class="logs-table-wrapper">
            <table class="logs-table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Détails</th>
                    <th>Utilisateur</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td>
                            <?= date("d/m/Y H:i:s", strtotime($log['created_at'])) ?>
                        </td>

                        <td>
                            <?= $this->e($log['action_type']) ?>
                        </td>

                        <td>
                            <?= $this->e($log['details']) ?>
                        </td>

                        <td>
                            <?= isset($log['id_user']) ? $this->e($log['id_user']) : "Anonyme" ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>

</div>
