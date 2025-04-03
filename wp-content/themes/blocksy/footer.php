<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blocksy
 */

blocksy_after_current_template();
do_action('blocksy:content:bottom');

?>
	</main>

	<?php
		do_action('blocksy:content:after');
		do_action('blocksy:footer:before');

		blocksy_output_footer();

		do_action('blocksy:footer:after');
	?>


<?php wp_footer(); ?>


<div id="modal" class="modal">
    <div class="modal-content">
        <div class="main-modal-content">
            <span class="modal-content-maintext">Оформление заказа</span>
            <span class="close" id="closeModal">&times;</span>
        </div>
        <form id="modal-order" action="." method="post">
            <div class="form-container">
                <div class="form-item">
                    <label for="phone">Ваше имя:</label>
                    <input type="text" id="username" name="username" required pattern="[a-zA-Z\u0400-\u04ff\s]{2,30}" title="Допускаются латинские и русские символы, в количестве от 2">
                </div>
                <div class="form-item">
                    <label for="phone">Номер телефона:</label>
                    <input type="text" id="phone" name="phone"  class="phone" required placeholder="+7 (999) 999-99-99">
                </div>
            </div>
            <div class="order-final-form">
                <button class="form-order-btn" type="submit">Отправить</button>
                <span id="result-order" class="result-order-active"></span>
            </div>
            
        </form>
    </div>
</div>
</body>
</html>
