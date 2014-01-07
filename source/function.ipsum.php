<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {ipsum} plugin
 *
 * Type:     function<br>
 * Name:     ipsum<br>
 * Purpose:  fill in placeholder text
 *
 * @author Richard Watt <richard@cruciblesolutions.com>
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 * @return string
 */
function smarty_function_ipsum($params, $template)
{
    if (isset($params['ipsum'])) {
      $ipsum = $params['ipsum'];
    } else {
      $ipsum = "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? ";
      $ipsum .= "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.";
    }

    $ipsum = explode(' ', $ipsum);

    if (is_numeric($params['paragraphs'])) {
      $paragraphs = $params['paragraphs'];
    } else { $paragraphs = 2; }

    if (is_numeric($params['words'])) {
      $words = $params['words'];
    } else { $words = 50; }

    // Make more if required
    while ($words > count($ipsum)) {
      $ipsum = array_merge($ipsum, $ipsum);
    }

    if (isset($params['html'])) {
      $tags = array(
        '<a href="#">%s</a>',
        '<strong>%s</strong>',
        '<em>%s</em>'
      );
      foreach($tags AS $tag) {
        for($j=0;$j<(ceil($words/10)+4);$j++) {
          $index = rand(0, count($ipsum));
          $ipsum[$index] = sprintf($tag, $ipsum[$index]);
        }
      }
    }

    if (isset($params['random'])) {
      $random = true;
      shuffle($ipsum);
      array_walk($ipsum, create_function('&$val', '$val = strtolower(trim($val, ".?,"));'));
    } else { $random = false; }

    /* Wrap paragraphs in this */
    if (isset($params['break_start'])) { $break[0] = $params['break_start']; } else { $break[0] = '<p>'; }
    if (isset($params['break_end'])) { $break[1] = $params['break_end']; } else { $break[1] = '.</p>'; }

    $paragraph_length = floor($words/$paragraphs);

    for($i=0;$i<$paragraphs;$i++) {
      $lorem[] = trim(ucfirst(implode(' ', array_slice($ipsum, $paragraph_length*$i, $paragraph_length))),".");
    }
    return $break[0] . join($break[1].$break[0], $lorem) . $break[1];
}
