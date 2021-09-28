<div class="mb-6 flex items-center justify-center">
    <div class="flex items-center p-1 border border-border rounded-xs">

        <div class="flex items-center ml-2">
            <a href="#"
               class="w-4/4 h-3 leading-12 text-center text-gray-main text-lg flex items-center justify-center border-l border-border">
                <span class="icon-angle-down flex items-center justify-center transform -rotate-90 text-0/7 scale-75 w-0/5"></span>
                <span class="icon-angle-down flex items-center justify-center transform -rotate-90 text-0/7 scale-75 w-0/5"></span>
            </a>
            <a href="#"
               class="w-4/4 h-3 leading-12 text-center text-gray-main text-lg flex items-center justify-center border-l border-border ">
                <span class="icon-angle-down flex items-center justify-center transform -rotate-90 text-0/7 scale-75"></span>
            </a>
        </div>


        <ul class="flex items-center space-x-reverse space-x-1/5">
			
			<?php
				$window_width = (int)"<script type='text/javascript'>document.write(window.innerWidth);</script>";
				if ($window_width < 768) {
					for ($x = 1; $x < 7; $x++) {
						
						echo '<li>
					<a href="#" class=" w-3 h-3 leading-12 text-center text-gray-main text-lg flex items-center justify-center rounded-xs">' . $x . '</a>
				</li>';
					
					}
				} else {
					for ($x = 1; $x < 3; $x++) {
						echo '<li>
					<a href="#" class=" w-3 h-3 leading-12 text-center text-gray-main text-lg flex items-center justify-center rounded-xs">' . $x . '</a>
				</li>';
					
					}
				}
			?>
        </ul>


        <div class="flex items-center mr-2">
            <a href="#"
               class="w-4/4 h-3 leading-12 text-center text-gray-main text-lg flex items-center justify-center border-border border-r">
                <span class="icon-angle-down flex items-center justify-center transform rotate-90 text-0/7 scale-75"></span>
            </a>
            <a href="#"
               class="w-4/4 h-3 leading-12 text-center text-gray-main text-lg flex items-center justify-center border-border border-r">
                <span class="icon-angle-down flex items-center justify-center transform rotate-90 text-0/7 scale-75 w-0/5"></span>
                <span class="icon-angle-down flex items-center justify-center transform rotate-90 text-0/7 scale-75 w-0/5"></span>
            </a>
        </div>

    </div>
</div>

