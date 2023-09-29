<div class="btn-circle" id="btn_wrapper">
    </a>
    <a href="<?php echo $settings['video_url'] ?>" class="youtube_logo" data-fancybox>
    <?php \Elementor\Icons_Manager::render_icon($settings['video_icon'], ['aria-hidden' => 'true']); ?>
    </a>
    <div class="text">
        <p>.Know About MY Self. By A Quick Video</p>
    </div>
</div>


<script>
    const text = document.querySelector(".btn-circle .text p");

text.innerHTML = text.innerText
  .split("")
  .map(
    (char, i) =>
      `<span style="transform:rotate(${i * 9.5}deg)">${char}</span>`
  )
  .join("");

</script>