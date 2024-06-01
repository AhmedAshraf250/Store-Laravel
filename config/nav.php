<?php
// اى عنصر موجود فى السايد بار او الناف اهم 3 اشياء بطبيعة الحال لابد من وجودهم فى اى عنصر موجود
// اسمه والرابط الخاص به وايقون تدل عليه مثلا
return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.',
        'title' => 'Dashboard',
        'active' => 'dashboard.'
    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'new',
        'active' => 'dashboard.categories.*'
    ],
    [
        'icon' => 'nav-icon fas fa-edit',
        'route' => 'dashboard.categories.index',
        'title' => 'Stores',
        'active' => 'dashboard.stores.*'
    ],
    [
        'icon' => 'nav-icon fas fa-columns',
        'route' => 'dashboard.categories.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*'
    ],
    [
        'icon' => 'nav-icon fas fa-columns',
        'route' => 'dashboard.categories.index',
        'title' => 'Orders',
        'active' => 'dashboard.orders.*'
    ]
];
// الفكره هنا لو اردت ان اضيف عنصر جديد للناف-بار ما علي سوى ان اضيفه هنا واعرف له خصائصه زى اسمه والايقون للدلاله عليه بجانب الرابط الخاص به
// وده بدلا من انى اروح على ملف الفيو واقعد اعرف واصمم الجزء الجديد هذا, ما على سوى انى اعرف الكونفيجراشن الخاص بالعنصر الجديد (ايقون-راوت-تايتل) اللى بنريد نضيفه
// وبعد كدا هنخلى مسئولية الكومبوننت المرتبط بهنا هو اللى يعرض الناف مثلاً
// look => 'app\View\Components\Nav.php' & 'resources\views\components\nav.blade.php'
