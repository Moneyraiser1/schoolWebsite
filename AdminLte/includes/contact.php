<?php 
include 'AdminController/AdminUserController.php';
$controller = new AdminUserController();
$complaints = $controller->fetchComplaints();

?>


<!-- Complaints Cards -->
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <?php foreach ($complaints as $complaint) { ?>
            <div class="col-sm-4 complaint-card" data-id="<?php echo $complaint['id']; ?>">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><?php echo htmlspecialchars($complaint["title"]); ?></strong>
                        <?php if ($complaint["is_read"] === 'unread'): ?>
                            <p class="text-danger unread-label">Unread</p>
                            <span class="label label-danger pull-right unread-badge">New</span>
                        <?php else: ?>
                            <p class="text-muted">Read</p>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#complaint-details-<?php echo $complaint["id"]; ?>">
                            View Details
                        </button>
                    </div>
                </div>

                <div class="collapse" id="complaint-details-<?php echo $complaint["id"]; ?>">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <p><?php echo nl2br(htmlspecialchars($complaint["description"])); ?></p>
                            <p><strong>Submitted by:</strong> <?php echo htmlspecialchars($complaint["username"]); ?></p>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($complaint["date_sent"]); ?></p>
                            <?php if ($complaint["is_read"] == 'unread'): ?>
                                <button class="btn btn-primary btn-sm mark-read-btn" data-id="<?php echo $complaint['id']; ?>">Mark as Read</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- JQuery + AJAX Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.mark-read-btn').click(function() {
        var id = $(this).data('id');
        var card = $('.complaint-card[data-id="' + id + '"]');

        $.post('includes/mark_as_read.php', { id: id }, function(response) {
            // Remove unread indicators
            card.find('.unread-label').remove();
            card.find('.unread-badge').remove();
            card.find('.mark-read-btn').remove();

            // Append "Read" label
            card.find('.panel-heading').append('<p class="text-muted text-danger">Read</p>');
        });
    });
});
</script>
