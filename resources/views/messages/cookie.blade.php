<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <script src="https://cdn.websitepolicies.io/lib/cconsent/cconsent.min.js" defer></script>
    <script>
        window.addEventListener("load",function(){
            window.wpcb.init({
                "border":"thin",
                "corners":"small",
                "colors":{
                    "popup":{
                        "background":"#cff5ff",
                        "text":"#000000",
                        "border":"#5e99c2"
                    },
                    "button":{
                        "background":"#5e99c2",
                        "text":"#ffffff"
                    }
                },
                "content":{
                    "message":"This website uses cookies to ensure you get the best experience on our website.",
                    "link":"<a href='https://github.com/theFeated' target='_blank'>Learn more</a>",
                    "button":"Got it!"
                },
                "position":"bottom-right"
            });
        });
    </script>

</body>
</html>
