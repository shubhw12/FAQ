<?php
namespace ElementorHelloWorld\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\repeater;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
wp_enqueue_style('elementor-hello-world-css');
class Hello_World extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hello-world';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Hello World', 'elementor-hello-world' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'elementor-hello-world' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor-hello-world' ),
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'question',
			[
				'label' => __( 'Question', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'answer',
			[
				'label' => __( 'Answer', 'elementor-hello-world' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Accordion Content', 'elementor-hello-world' ),
				'show_label' => true,
			]
		);




		$this->add_control(
			'tabs',
			[
				'label' => __( 'Accordion Items', 'elementor-hello-world' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'question' => __( 'Accordion #1', 'elementor-hello-world' ),
						'answer' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-hello-world' ),
					],
				],
				'title_field' => '{{{ question }}}',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'elementor-hello-world' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-plus',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'selected_active_icon',
			[
				'label' => __( 'Active Icon', 'elementor-hello-world' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon_active',
				'default' => [
					'value' => 'fas fa-minus',
					'library' => 'fa-solid',
				],
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Accordion', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(	
			'icon_align',
			[
				'label' => __( 'Alignment', 'elementor-hello-world' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Start', 'elementor-hello-world' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'End', 'elementor-hello-world' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => is_rtl() ? 'right' : 'left',
				'toggle' => false,
				'label_block' => false,
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'elementor-hello-world' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title.elementor-accordion-item' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title.elementor-accordion-item .uael-accordion-content' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title.elementor-accordion-item' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title.elementor-accordion-item .elementor-tab-content' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title.elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'uael-title-style',
			[
				'label' => __( 'Title', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_background',
			[
				'label' => __( 'Background', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();


	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
			$settings = $this->get_settings_for_display();?>
			<script type="text/javascript">
					jQuery('.uael-accordion-content').attr('style', 'display:none');
			</script>
					<div class ="uael-faq-wrapper">
						<div class="uael-faq-container">
							<?php foreach ($settings['tabs'] as $key ) {?>
							<div class="uael-faq-accordion">
								<div class="uael-accordion-title elementor-accordion-item">
									<?php echo $key['question'];?>
									<!-- elementor-accordion-icon elementor-accordion-icon-left -->
							<span class="elementor-accordion-icon elementor-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
								<span class="elementor-accordion-icon-closed"><?php Icons_Manager::render_icon( $settings['selected_icon'] ); ?></span>
								<span class="elementor-accordion-icon-opened"><?php Icons_Manager::render_icon( $settings['selected_active_icon'] ); ?></span>
							</span>
									<div class="uael-accordion-content">
										<?php echo $key['answer'];?>
									</div>
								</div>	
							</div>
						<?php } ?>
						</div>
					</div>
			<?php
			//schema logic
			$object_data = array();
			$json_data = array (
			  '@context' => 'https://schema.org',
			  '@type' => 'FAQPage',
			);
			foreach ($settings['tabs'] as $key ) {
				$new_data =    array (
					  '@type' => 'Question',
					  'name' => $key['question'],
					  'acceptedAnswer' => 
					  array (
					    '@type' => 'Answer',
					    'text' => $key['answer'],
					  ),
				);
				array_push($object_data,$new_data);
			}
			$json_data['mainEntity'] = $object_data;
			$encoded_data = json_encode($json_data);
			 // echo $json_data;
			 ?><script type="application/ld+json">
					<?php //print_r($encoded_data);?>
			</script><?php	
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<# 
			console.log(settings.tabs);
		#>
		<?php
	}
}
