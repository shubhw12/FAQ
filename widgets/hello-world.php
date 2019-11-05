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
				'default' => 'Question',
			]
		);

		$repeater->add_control(
			'answer',
			[
				'label' => __( 'Answer', 'elementor-hello-world' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Accordion Content', 'elementor-hello-world' ),
				'show_label' => true,
				'default' => 'Answer',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Accordion', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'uael-border-width',
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
					'{{WRAPPER}} .uael-faq-container .uael-faq-accordion' => 'border-style: solid; border-width:{{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0px {{SIZE}}{{UNIT}} ;',
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-content' => 'border-style: solid; border-top-width: {{SIZE}}{{UNIT}} ;',
					'{{WRAPPER}} .uael-faq-container:last-child' => 'border-style: solid; border-bottom: {{SIZE}}{{UNIT}} solid;',
				],	
			]
		);

		$this->add_control(
			'uael-border-color',
			[
				'label' => __( 'Border Color', 'elementor-hello-world' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [


					'{{WRAPPER}} .uael-faq-container .uael-faq-accordion' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-content' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .uael-faq-container:last-child' => 'border-color: {{VALUE}};',



					// '{{WRAPPER}} .uael-faq-container .uael-faq-accordion .uael-accordion-title.uael-title-active' => 'border-color: {{VALUE}};',
					// '{{WRAPPER}} .uael-faq-container .uael-faq-accordion .uael-accordion-title' => 'border-color: {{VALUE}};',
					// '{{WRAPPER}} .uael-faq-container .uael-faq-accordion .uael-accordion-content' => 'border-style:solid;border-color: {{VALUE}};',
					// '{{WRAPPER}} .uael-faq-container .uael-faq-accordion .uael-accordion-content'=> 'border-color:{{VALUE}};border-color: {{VALUE}};',
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
			'uael-title_background',
			[
				'label' => __( 'Background', 'elementor-hello-world' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'uael-title-color',
			[
				'label' => __( 'Color', 'elementor-hello-world' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'uael-title-active-color',
			[
				'label' => __( 'Active Color', 'elementor-hello-world' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title.uael-title-active' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .uael-faq-accordion .uael-accordion-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'elementor-hello-world' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'uael-content-style',
			[
				'label' => __( 'Content', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'uael-content-background',
			[
				'label' => __( 'Background', 'elementor-hello-world' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-content' => 'background-color: {{VALUE}};',
				],
				'default' => '#ffffff',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .uael-faq-accordion .uael-accordion-content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_responsive_control(
			'uael-content-padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .uael-faq-accordion .uael-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'uael-icon-style',
			[
				'label' => __( 'Icon', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Start', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'End', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => is_rtl() ? 'right' : 'left',
				'toggle' => false,
				'label_block' => false,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				// 'selectors' => [
				// 	'{{WRAPPER}} .uael-faq-accordion .uael-accordion-content' => 'color: {{VALUE}};',
				// ],
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' => __( 'Active Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [	
					'px' => [
						'min' => 0,
						'max' => 100,
					],
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
			$settings = $this->get_settings_for_display();
			var_dump($settings['icon_align']);?>
			<script type="text/javascript">
					jQuery('.uael-accordion-content').attr('style', 'display:none');
			</script>
					<div class ="uael-faq-wrapper">
						<div class="uael-faq-container">
							<?php foreach ($settings['tabs'] as $key ) {?>
							<div class="uael-faq-accordion">
								<div class="uael-accordion-title">
									<?php echo $key['question'];?>
							<span class="uael-accordion-icon uael-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" >
								<span class="uael-accordion-icon-closed"><?php Icons_Manager::render_icon( $settings['selected_icon'] ); ?></span>
								<span class="uael-accordion-icon-opened"><?php Icons_Manager::render_icon( $settings['selected_active_icon'] ); ?></span>
							</span>
								</div>
								<div class="uael-accordion-content">
									<?php echo $key['answer'];?>
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
					<?php print_r($encoded_data);?>
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
