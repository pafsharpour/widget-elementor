<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Pariya Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Pariya_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve pariya widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'pariya';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve pariya widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Pariya', 'elementor-pariya-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve pariya widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-bullet-list';
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'list', 'lists', 'ordered', 'unordered','image' ];
	}

	/**
	 * Register pariya widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'List Content', 'elementor-pariya-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		/* Start repeater */

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'elementor-pariya-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'List Item', 'elementor-pariya-widget' ),
				'default' => esc_html__( 'List Item', 'elementor-pariya-widget' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor-pariya-widget' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor-pariya-widget' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		/* End repeater */

		$this->add_control(
			'timeline_items',
			[
				'label' => esc_html__( 'timeline_items', 'elementor-pariya-widget' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),           /* Use our repeater */
				'default' => [
					[
						'text' => esc_html__( 'List Item #1', 'elementor-pariya-widget' ),
						'link' => '',
					],
					[
						'text' => esc_html__( 'List Item #2', 'elementor-pariya-widget' ),
						'link' => '',
					],
					[
						'text' => esc_html__( 'List Item #3', 'elementor-pariya-widget' ),
						'link' => '',
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => esc_html__( 'List Style', 'elementor-pariya-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'elementor-pariya-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-pariya-widget-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-pariya-widget-text > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elementor-pariya-widget-text, {{WRAPPER}} .elementor-pariya-widget-text > a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .elementor-pariya-widget-text',
			]
		);

		$this->end_controls_section();

		// $this->start_controls_section(
		// 	'style_marker_section',
		// 	[
		// 		'label' => esc_html__( 'Marker Style', 'elementor-pariya-widget' ),
		// 		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_control(
		// 	'marker_color',
		// 	[
		// 		'label' => esc_html__( 'Color', 'elementor-pariya-widget' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .elementor-pariya-widget-text::marker' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'marker_spacing',
		// 	[
		// 		'label' => esc_html__( 'Spacing', 'elementor-pariya-widget' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', 'em', 'rem', 'custom' ],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
		// 			'em' => [
		// 				'min' => 0,
		// 				'max' => 10,
		// 			],
		// 			'rem' => [
		// 				'min' => 0,
		// 				'max' => 10,
		// 			],
		// 		],
		// 		'default' => [
		// 			'unit' => 'px',
		// 			'size' => 40,
		// 		],
		// 		'selectors' => [
		// 			// '{{WRAPPER}} .elementor-pariya-widget' => 'padding-left: {{SIZE}}{{UNIT}};',
		// 			'{{WRAPPER}} .elementor-pariya-widget' => 'padding-inline-start: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->end_controls_section();

	}

	/**
	 * Render list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

     protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
     
         <div class="center">
             <ul class="sobelz_zigzag_list_item">
                 <?php
                    foreach ( $settings['timeline_items'] as $index => $item ) {
                        //get key of repeater controls
                    $repeater_setting_key = $this->get_repeater_setting_key( 'text', 'timeline_items', $index );
                    // add attributes to this controlls
                    $this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-timeline-sobelz-text' );
                    $this->add_inline_editing_attributes( $repeater_setting_key );
                 ?>
     
                     <li>
                         
                         <div class="circle">
                            <div class="imageWraper">
                            <?php
                            $image =  $settings['timeline_items'][$index]['image']['url'];
                            echo  '<img src="' . $image . '">';  
                             ?>
                            </div>
                             
                            <div <?php $this->print_render_attribute_string( $repeater_setting_key ); ?>>
                               <?php
                               $title = $settings['timeline_items'][$index]['text'];
                               echo $title;
                               ?>
                            </div>
                        </div>
                     </li>
                <?php
                 }
                ?>
             </ul>
         </div>
     <?php
     }
     

}