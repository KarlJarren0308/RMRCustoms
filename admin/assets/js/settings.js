var configureSetting = function($name, $value) {
    $.ajax({
        url: 'requests/configure_settings.php',
        method: 'POST',
        data: {
            action: 'Configure',
            name: $name,
            value: $value
        }
    });

    return false;
}