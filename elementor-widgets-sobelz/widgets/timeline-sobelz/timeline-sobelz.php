<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Timeline_Sobelz extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve list widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'timeline-sobelz';
    }

    /**
     * Get widget title.
     *
     * Retrieve list widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'timeline-sobelz', 'elementor-timeline-sobelz' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve list widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-bullet-list';
    }

    /**
     * Get custom help URL.
     *
     * Retrieve a URL where the user can get more information about the widget.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget help URL.
     */
    public function get_custom_help_url() {
        return 'https://developers.elementor.com/docs/widgets/';
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
        return [ 'timeline sobelz', 'timeline', 'sobelz' ];
    }



    public function get_style_depends() {
        return [ 'styl-timeline-sobelz' ];

    }


    /**
     * Register list widget controls.
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
                'label' => esc_html__( 'timeline Content', 'elementor-timeline-sobelz' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        /* Start repeater */

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'elementor-timeline-sobelz' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'List Item', 'elementor-timeline-sobelz' ),
                'default' => esc_html__( 'List Item', 'elementor-timeline-sobelz' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'elementor-timeline-sobelz' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'elementor-timeline-sobelz' ),
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
                'label' => esc_html__( 'timeline_items', 'elementor-timeline-sobelz' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),           /* Use our repeater */
                'default' => [
                    [
                        'text' => esc_html__( 'List Item #1', 'elementor-timeline-sobelz' ),
                        'link' => '',
                        'image'=> '',
                    ],
                    [
                        'text' => esc_html__( 'List Item #2', 'elementor-timeline-sobelz' ),
                        'link' => '',
                        'image'=> '',
                    ],
                    [
                        'text' => esc_html__( 'List Item #3', 'elementor-timeline-sobelz' ),
                        'link' => '',
                        'image'=> '',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_content_section',
            [
                'label' => esc_html__( 'timeline Style', 'elementor-timeline-sobelz' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'elementor-timeline-sobelz' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-timeline-sobelz-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-timeline-sobelz-text > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'icon_typography',
                'selector' => '{{WRAPPER}} .elementor-timeline-sobelz-text, {{WRAPPER}} .elementor-timeline-sobelz-text > a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .elementor-timeline-sobelz-text',
            ]
        );

        $this->add_control(
            'cards_bg',
            array(
                'label'     => __( 'Background Color', 'elementor-timeline-sobelz'  ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}} .elementor-timeline-sobelz-text' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->end_controls_section();



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
                ?>
                <!-- <ul class="sobelz_zigzag_list_item"> -->
                <?php
               $repeater_setting_key = $this->get_repeater_setting_key( 'text', 'timeline_items', $index );
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
            <!-- </ul> -->

           <?php
            }
           ?>
        </ul>
    </div>
<?php
}





/**
 * Render list widget output in the editor.
 *
 * Written as a Backbone JavaScript template and used to generate the live preview.
 *
 * @since 1.0.0
 * @access protected
 */
protected function content_template() {

    ?>
    <# #>
    <div class="center">
        <ul class="sobelz_zigzag_list_item">
    
          <# _.each( settings.timeline_items, function( item, index ) {
            var repeater_setting_key = view.getRepeaterSettingKey( 'text', 'timeline_items', index );
            view.addRenderAttribute( repeater_setting_key, 'class', 'elementor-timeline-sobelz-text' );
            view.addInlineEditingAttributes( repeater_setting_key );          
          #>
           <li>
			 <div class="circle">
				   
                  <div class="imageWraper" >
				  <# var image =  item.image.url; #>
                  <img src=" {{image}} ">	
                  </div>

                  <div {{{ view.getRenderAttributeString( repeater_setting_key ) }}}> 
				  <# var title = item.text; #>	
                  {{{title}}}
                  </div>
			 </div>
					  
           </li>
            <# } ); #>    
        </ul>
    </div>

<?php
}

}