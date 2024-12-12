<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <title>Event Management System</title>
    <?= $this->include('admin/header_link'); ?>
</head>

<body>

    <div class="wrapper">
        <?php if (!isset($isLoginPage) || !$isLoginPage): ?>
            <?= $this->include('admin/sidebar.php'); ?>
        <?php endif; ?>
        
        <div class="main">
            <?php if (!isset($isLoginPage) || !$isLoginPage): ?>
                <?= $this->include('admin/header.php'); ?>
            <?php endif; ?>

            <main class="content">
                <?= $this->renderSection('content'); ?>
            </main>

            <?php if (!isset($isLoginPage) || !$isLoginPage): ?>
                <?= $this->include('admin/footer.php'); ?>
            <?php endif; ?>
        </div>
    </div>

    <?= $this->include('admin/footer_link.php'); ?>

</body>

</html>
