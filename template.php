<?php
/**
 * Implements theme_menu_link().
 *
 * Overrides ulf_defaults version of theme menu link.
 *
 * @param $variables
 *  Available variables.
 *
 * @return string
 *  HTML string for a list item.
 */
function ulf_viborg_menu_link__main_menu($variables){
  $element = $variables['element'];
  $sub_menu = '';

  // Set type of link based on title of link.
  switch ($element['#title']) {
    case 'Dagtilbud':
      $element['#localized_options']['attributes']['class'][] = 'is-daycare';
      break;
    case 'Grundskole':
      $element['#localized_options']['attributes']['class'][] = 'is-school';
      break;
    case 'Ungdomsuddannelse':
      $element['#localized_options']['attributes']['class'][] = 'is-youth';
      break;
    case 'Kurser':
      $element['#localized_options']['attributes']['class'][] = 'is-course';
      break;
    case 'Om os':
      // Make Om ULF a dropdown.
      $menu_array = module_invoke('menu', 'block_view', 'menu-about-ulf');
      $element['#attributes']['class'][] = 'js-toggle-about';
      $sub_menu = '<div class="nav--sub js-about-menu is-hidden"><ul class="nav--static-pages is-menu">' . render($menu_array['content']) . '</ul></div>';
      break;
  }

  $element['#attributes']['class'][] = 'nav--list-item';
  $element['#localized_options']['attributes']['class'][] = 'nav--list-link';
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);

  return "<li" . drupal_attributes($element['#attributes']) . ">" . $output . $sub_menu . "</li>" ;
}