<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
    <title><?php echo $vars['title']; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <base href="<?php echo $this->getBaseURL(); ?>/" />
    <?php if (!empty($vars['css'])) echo $vars['css']; ?>
    <?php echo $this->cssString('smoothness/jquery-ui'); ?>
    <style type="text/css">
    <?php hook('output_css'); ?>
    </style>
</head>

<body>