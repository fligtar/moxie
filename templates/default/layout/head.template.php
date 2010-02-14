<!DOCTYPE html>
<html lang="en-US">

<head>
    <title><?php echo $page_title; ?></title>
    <meta charset="utf-8" />
    <base href="<?php echo $this->url(); ?>/" />
    <?php if (!empty($css)) echo $css; ?>
    <?php echo $this->cssString('smoothness/jquery-ui'); ?>
</head>

<body class="body-<?php echo $page_id; ?> <?php if (!empty($body_class)) echo $body_class; ?>">