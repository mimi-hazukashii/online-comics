<?php
get_header();
get_template_part('template-parts/' . get_query_var('mimi_action') === 'read' ? 'read' : 'info');
get_footer();