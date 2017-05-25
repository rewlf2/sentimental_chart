<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="footer-container container-fluid">
    <footer>
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
            seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
        </p>
    </footer>
</div>
<?php echo $before_closing_body; ?>
</body>
</html>