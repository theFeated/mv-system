<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Illegal Access Warning</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('portfolio_assets/css/glitch.css') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://unpkg.com/powerglitch@latest/dist/powerglitch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        :root {
            --stripe-size: 100px;
            --color1: #c44;
            --color2: #313131;
            --duration: 2s;
        }

        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .stripe {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;

            .stripe_inner {
                position: relative;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100%;
                font-size: 8rem;
                text-align: center;
                font-family: 'Anton', sans-serif;
                color: rgba(#fff, 0);
                background: repeating-linear-gradient(
                    45deg,
                    var(--color1) 25%,
                    var(--color1) 50%,
                    var(--color2) 50%,
                    var(--color2) 75%
                );
                background-size: var(--stripe-size) var(--stripe-size);
                background-clip: text;
                animation: stripeBackgroundPosition var(--duration) linear infinite;
            }

            &::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: calc(100% + var(--stripe-size));
                height: 100%;
                background: repeating-linear-gradient(
                    45deg,
                    var(--color2) 25%,
                    var(--color2) 50%,
                    var(--color1) 50%,
                    var(--color1) 75%
                );
                background-size: var(--stripe-size) var(--stripe-size);
                animation: stripeTransform var(--duration) linear infinite;
            }

            &::after {
                content: '';
                position: absolute;
                width: 100%;
                height: 100%;
                background: radial-gradient(ellipse at center, rgba(#1b2735, 0) 0%, #090a0f 100%);
            }

            .stripe_inner .btn {
                margin-top: 1rem;
            }
        }

        @media (max-width: 767.98px) {
            .stripe {
                .stripe_inner {
                    font-size: 5rem;
                }
            }
        }

        @keyframes stripeTransform {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(var(--stripe-size) * -1));
            }
        }

        @keyframes stripeBackgroundPosition {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: calc(var(--stripe-size) * -1) 0;
            }
        }
    </style>
</head>
<body>

<div class="stripe">
    <div class="stripe_inner">
        <div class='glitch'>
            <p>Warning</p>
        </div>

        <div class="text-center mt-3" style="z-index:1;">
          @if(isset($blockDuration) && $blockDuration > 0)
              <div class="timer text-center row" 
              style="z-index:100; font-size: 16px; color:pink;">
                  Time remaining: <?php echo $blockDuration; ?> seconds
            </div>
          @endif
        </div>

        <div class="text-center mt-3" style="z-index:1;">
            <!-- Button HTML (to Trigger Modal) -->
            <a href="#myModal" class="btn btn-dark border-white" data-toggle="modal">Click to Open</a>
        </div>
    </div>

</div>

  <!-- Modal HTML -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Warning!</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>{{ $message }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        PowerGlitch.glitch('.glitch', {
            timing: {
                duration: 1000,
                easing: "ease-in-out"
            }
        });

        // Apply CSS animation to change text color during glitch animation
        var glitchElements = document.querySelectorAll('.glitch');
        glitchElements.forEach(function(element) {
            var textElement = element.querySelector('p');
            textElement.style.animation = 'glitchText 3s infinite';
        });
    });
  </script>

  <style>
      @keyframes glitchText {
          0% {
              color: black; /* Initial color */
          }
          25% {
              color: red; /* Glitch color */
          }
          50% {
              color: black;/* Back to initial color */
          }
          75% {
              color: red; /* Glitch color */
          }
          100% {
              color: black; /* Back to initial color */
          }
      }
  </style>

      @if(isset($blockDuration) && $blockDuration > 0)
          <script>
          var timerValue = <?php echo $blockDuration; ?>;
          var timer = document.querySelector('.timer');

          function updateTimer() {
              timer.textContent = 'Time remaining: ' + timerValue + ' seconds';
              timerValue--;
              if (timerValue < 0) {
                  clearInterval(intervalId);
                  timer.textContent = 'Redirecting...';
                  setTimeout(function() {
                      // Check if the user is authenticated
                      @if(Auth::check())
                          window.location.href = "{{ route('login') }}";
                      @else
                          window.location.href = "/";
                      @endif
                  }, 2000);
              }
          }

          updateTimer();
          var intervalId = setInterval(updateTimer, 1000);
        </script>
      @endif
      
</body>
</html>