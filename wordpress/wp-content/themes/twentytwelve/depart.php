<?php

/**
 * ����ժҪ
 * @param (string) $body
 *  ����
 * @param (int) $size
 *  ժҪ����
 * @param (int) $format
 *  �����ʽ id
 */
function blog_summary($body, $size, $format = NULL){
  $_size = mb_strlen($body, 'utf-8');

  if($_size <= $size) return $body;

  // �����ʽ���� PHP ������
//  if(!isset($format) && filter_is_php($format)){
//    return $body;
//  }

  $strlen_var = strlen($body);

  // ������ html ��ǩ
  if(strpos($body, '<') === false){
    return mb_substr($body, 0, $size);
  }

  // �����ضϱ�־������
  if($e = strpos($body, '<!-- break -->')){
    return mb_substr($body, 0, $e);
  }

  // html ������
  $html_tag = 0;

  // ժҪ�ַ���
  $summary_string = '';

  /**
   * ����������¼ժҪ��Χ�ڳ��ֵ� html ��ǩ
   * ��ʼ�ͽ����ֱ𱣴��� left �� right ������
   * ���ַ���Ϊ��<h3><p><b>a</b></h3>������ p δ�պ�
   * ������Ϊ��array('left' => array('h3', 'p', 'b'), 'right' => 'b', 'h3');
   * ����ȫ html ��ǩ��<? <% ���������Ա�ǣ����������Ԥ֪���
   */
  $html_array = array('left' => array(), 'right' => array());
  for($i = 0; $i < $strlen_var; ++$i) {
    if(!$size){
      break;
    }

    $current_var = substr($body, $i, 1);

    if($current_var == '<'){
      // html ���뿪ʼ
      $html_tag = 1;
      $html_array_str = '';
    }else if($html_tag == 1){
      // һ�� html �������
      if($current_var == '>'){
        /**
         * ȥ����β�ո��� <br /  > < img src="" / > �ȿ��ܳ�����β�ո�
         */
        $html_array_str = trim($html_array_str);

        /**
         * �ж����һ���ַ��Ƿ�Ϊ /�����ǣ����ǩ�ѱպϣ�����¼
         */
        if(substr($html_array_str, -1) != '/'){

          // �жϵ�һ���ַ��Ƿ� /�����ǣ������ right ��Ԫ
          $f = substr($html_array_str, 0, 1);
          if($f == '/'){
            // ȥ�� /
            $html_array['right'][] = str_replace('/', '', $html_array_str);
          }else if($f != '?'){
            // �ж��Ƿ�Ϊ ?�����ǣ���Ϊ PHP ���룬����

            /**
             * �ж��Ƿ��а�ǿո����У��Կո�ָ��һ����ԪΪ html ��ǩ
             * �� <h2> <p>
             */
            if(strpos($html_array_str, ' ') !== false){
              // �ָ��2����Ԫ�������ж���ո��磺<h2 class="" id="">
              $html_array['left'][] = strtolower(current(explode(' ', $html_array_str, 2)));
            }else{
              /**
               * * ��û�пո������ַ���Ϊ html ��ǩ���磺<b> <p> ��
               * ͳһת��ΪСд
               */
              $html_array['left'][] = strtolower($html_array_str);
            }
          }
        }

        // �ַ�������
        $html_array_str = '';
        $html_tag = 0;
      }else{
        /**
         * ��< >֮����ַ����һ���ַ���
         * ������ȡ html ��ǩ
         */
        $html_array_str .= $current_var;
      }
    }else{
      // �� html ����ż���
      --$size;
    }

    $ord_var_c = ord($body{$i});

    switch (true) {
      case (($ord_var_c & 0xE0) == 0xC0):
        // 2 �ֽ�
        $summary_string .= substr($body, $i, 2);
        $i += 1;
      break;
      case (($ord_var_c & 0xF0) == 0xE0):

        // 3 �ֽ�
        $summary_string .= substr($body, $i, 3);
        $i += 2;
      break;
      case (($ord_var_c & 0xF8) == 0xF0):
        // 4 �ֽ�
        $summary_string .= substr($body, $i, 4);
        $i += 3;
      break;
      case (($ord_var_c & 0xFC) == 0xF8):
        // 5 �ֽ�
        $summary_string .= substr($body, $i, 5);
        $i += 4;
      break;
      case (($ord_var_c & 0xFE) == 0xFC):
        // 6 �ֽ�
        $summary_string .= substr($body, $i, 6);
        $i += 5;
      break;
      default:
        // 1 �ֽ�
        $summary_string .= $current_var;
    }
  }

  if($html_array['left']){
    /**
     * �ȶ����� html ��ǩ��������ȫ
     */

    /**
     * ���� left ˳�򣬲����˳��Ӧ�� html ���ֵ�˳���෴
     * �����ȫ���ַ���Ϊ��<h2>abc<b>abc<p>abc
     * ����˳��ӦΪ��</p></b></h2>
     */
    $html_array['left'] = array_reverse($html_array['left']);

    foreach($html_array['left'] as $index => $tag){
      // �жϸñ�ǩ�Ƿ������ right ��
      $key = array_search($tag, $html_array['right']);
      if($key !== false){
        // ���֣��� right ��ɾ���õ�Ԫ
        unset($html_array['right'][$key]);
      }else{
        // û�г��֣���Ҫ��ȫ
        $summary_string .= '</'.$tag.'>';
      }
    }
  }
  return $summary_string;
}

?>