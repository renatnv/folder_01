
/* Copyright © 2021 Renat Gazizov. All rights reserved. */

$(document).ready(function() {

    let 
    $menuContainer = $('#menuContainer'),
    $menuLabelMain = $('#menuLabelMain'),
    $menuButtonMain = $('#menuButtonMain'),
    $menuButtonFilter = $('#menuButtonFilter'),
    $menuSelectItem = $('.menuSelectItem'),
    $menuSelectAll = $('.menuSelectAll'),
    $item,
    $itemSumAll = $menuSelectItem.length,
    $itemSumVisible = $itemSumAll,
    $itemSumChecked,
    $paramSelectedAll,
    $paramSelectedItems,
    $paramButtonMainText;

    // Управление видимостью меню программ обучения
    $menuButtonMain.add($menuLabelMain).on('click', function() {
        $menuContainer.is(':hidden')
            ? $menuContainer.add($menuLabelMain).show()
            : $menuContainer.add($menuLabelMain).hide();
    });

    // Работа с меню программ обучения
    $menuContainer.on('click', function() {

        // Поиск по списку
        // Учитывает вариативность поведения пользователя
        $('input[type=text]').on('keyup', function() {
            $item = $(this).val().toLowerCase();
            $itemSumVisible = 0;
            $menuSelectItem.filter(function() {
                if ($(this).text().toLowerCase().indexOf($item) > -1) {
                    $itemSumVisible += 1;
                    $(this).show(100);
                } else {
                    $(this).find('input[type=checkbox]').prop('checked', false);
                    $(this).hide(100);
                }
            });
        });

        // Выбор всех программ обучения
        $menuSelectAll.find('input[type=checkbox]').on('change', function() {
            $menuSelectAll.find('input[type=checkbox]').prop('checked')
                ? $paramSelectedAll = true
                : $paramSelectedAll = false;
            $menuSelectItem.find('input[type=checkbox]:visible').prop('checked', $paramSelectedAll);
        });
        
        // Выбор отдельных программ обучения
        // Учитывает результаты поиска по списку
        $('input[type=text], input[type=checkbox]').on('keyup change', function() {
            $itemSumChecked = $menuSelectItem.find('input[type=checkbox]:checked:visible').length;
            if ($itemSumChecked === $itemSumVisible && $itemSumVisible !== 0) {
                $paramSelectedItems = true;
                $paramButtonMainText = 'Выбраны все программы';
            } else {
                $paramSelectedItems = false;
                $itemSumChecked > 0
                    ? $paramButtonMainText = $itemSumChecked + ' из ' + $itemSumAll + ' выбрано'
                    : $paramButtonMainText = 'Выбрать';
            }
            $menuSelectAll.find('input[type=checkbox]').prop('checked', $paramSelectedItems);
            $menuButtonMain.find('span:first-child').text($paramButtonMainText);
        });

    });
    
    // Отправка фильтра на сервер
    $menuButtonFilter.on('click', function () {
        $.ajax({
            url: '/ajax.php',
            type: 'post',
            data: $('form').serialize(),
            beforeSend: function() {
                $menuButtonFilter.val('Выполняется...');
            },
            success: function(msg) {
                $('#tableContent').html(msg);
                $menuContainer.add($menuLabelMain).hide();
                $menuButtonFilter.val('Фильтр');
            }
        });
    });

});
