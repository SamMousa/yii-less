Behavior to add LESS support to Yii.
========

Usage:
- Put the files in the extensions directory.
- Configure CClientScript to load this behavior
  'components' => array(
    'clientscript' => array(
      'behaviors' => array(
        'less' => array(
          'class' => 'ext.yii-less.LessBehavior'
        )
      )
    )
  )

- Register LESS file just like css files: 
  Yii::app()->getClientScript()->registerLessFile('/path/to/file');
