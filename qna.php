<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/accordion.css">
    <title>home</title>
  </head>
  <?php
  require 'includes/database.php';
  ?>

  <style> 
  .empty {
    margin-top: 60px;
  }
  </style>
  <body>
    <?php
        require "components/navbar.php";
    ?>

    <main>
    <section class="container">
    <div class="empty">
      </div>
      <div class="accordion">
        <div class="question">What is a virtual art gallery?</div>
        <div class="answer">A virtual art gallery is an online platform that allows artists to exhibit their works and viewers to browse them through the internet. It's like a digital version of a traditional gallery, where people can view artworks, interact with artists, and even purchase their pieces.</div>
      </div>
      <div class="accordion">
        <div class="question">How does a virtual art gallery work?</div>
        <div class="answer">A virtual art gallery often utilizes special software platforms or applications that enable artists to upload their works and organize them into exhibitions. Viewers can browse various exhibitions, zoom in on individual artworks, read information about the artist and the pieces, and sometimes even interact with other viewers.</div>
      </div>
      <div class="accordion">
        <div class="question">What are the advantages of a virtual art gallery compared to traditional ones?</div>
        <div class="answer">A virtual art gallery offers access to artworks from the comfort of one's home, meaning people from all over the world can see exhibitions and artworks they might not otherwise have the opportunity to visit. It also allows artists to showcase their works without the limitations of a physical gallery and its expenses.</div>
      </div>
      <div class="accordion">
        <div class="question">What are the disadvantages of a virtual art gallery?</div>
        <div class="answer">Some argue that a virtual art gallery lacks the same personal touch as a traditional one. There's a lack of interaction with artworks in real life and the ability to see them in a physical space. Additionally, technical issues such as slow loading times or limited graphical quality can impact the overall experience.</div>
      </div>
      <div class="accordion">
        <div class="question">How do virtual art galleries address issues like forgery and copyright?</div>
        <div class="answer">Virtual art galleries often implement measures to protect copyright and ensure that the works published on their platforms are authentic. This may include digital signatures, verification of artists' identities, and ensuring that transactions are secure and transparent. However, as it's a continuously evolving space, challenges in this area may still change and develop.</div>
      </div>
      <div class="accordion">
        <div class="question">What role does technology play in enhancing the virtual art gallery experience?</div>
        <div class="answer">Technology plays a crucial role in enhancing the virtual art gallery experience by providing features like 360-degree views of exhibitions, augmented reality to visualize artworks in one's own space, and virtual reality to immerse viewers in virtual gallery spaces.</div>
      </div>
      <div class="accordion">
        <div class="question">How do virtual art galleries facilitate interactions between artists and viewers?</div>
        <div class="answer">Virtual art galleries often include features such as live chat, artist interviews, and virtual tours guided by the artist. These elements allow for direct communication between artists and viewers, fostering engagement and a deeper understanding of the artworks.</div>
      </div>
      <div class="accordion">
        <div class="question">Are virtual art galleries accessible to everyone, regardless of their physical location or mobility?</div>
        <div class="answer">Yes, one of the significant advantages of virtual art galleries is their accessibility. People from any location with internet access can visit these galleries, eliminating geographical barriers. Additionally, individuals with mobility issues can enjoy art exhibitions from the comfort of their homes.</div>
      </div>
    </section>
  </main>

    <?php
        require 'components/footer.php';
    ?>
    <script src="js/accordion.js"></script>
  </body>
</html>
