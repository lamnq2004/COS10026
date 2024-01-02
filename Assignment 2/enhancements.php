<!DOCTYPE html>
<html lang="en">
<?php $title = "Enhancements";
include('head.inc'); ?>

<body>

  <?php include('header.inc'); ?>

  <h1 class="enhancements-heading">Enhancements</h1>
  <section class="enhancement-section">
    <div class="content">
      <table>
        <tr>
          <th>Enhancement</th>
          <th>Index Animations</th>
        </tr>
        <tr>
          <td>Description</td>
          <td>
            A Unique Animation present in the Home Page to make the website
            more attractive
          </td>
        </tr>
        <tr>
          <td>Code Required</td>
          <td>.scrolling { ... }, .marquee { ... } </td>
        </tr>
        <tr>
          <td>Link</td>
          <td><a href="./index.html">Home</a></td>
        </tr>
      </table>

      <br />

      <table>
        <tr>
          <th>Enhancement</th>
          <th>Mobile responsive for the Website</th>
        </tr>
        <tr>
          <td>Description</td>
          <td>allows for the website to viewed on mobile phones</td>
        </tr>
        <tr>
          <td>Code Required</td>
          <td> @media screen and (max-width: 768px) { ... } </td>
        </tr>
        <tr>
          <td>Link</td>
          <td>Please view the project on a mobile</td>
        </tr>
      </table>

      <br />

      <table>
        <tr>
          <th>Enhancement</th>
          <th>Text Animations</th>
        </tr>
        <tr>
          <td>Description</td>
          <td>
            Makes the website more vibrant and attractive by adding simple
            animations to the navigation bar
          </td>
        </tr>
        <tr>
          <td>Code Required</td>
          <td>
            .typewriter { position: absolute; top: 50%; left: 50%; transform:
            translate(-50%, -50%); width: fit-content; overflow: hidden;
            border-right: 0.1em solid var(--fg-tertiary); white-space: nowrap;
            margin: 0 auto; letter-spacing: 0.15em; animation: typing 3.5s
            steps(40, end), blink-caret 0.75s step-end infinite; }
          </td>
        </tr>
        <tr>
          <td>Link</td>
          <td>Hover your mouse over the buttons of the hotbar</td>
        </tr>
      </table>

      <br />

      <table>
        <tr>
          <th>Enhancement</th>
          <th>Hover Effects</th>
        </tr>
        <tr>
          <td>Description</td>
          <td>
            further builds on the animation by highlighting what button the
            mouse is hovering over
          </td>
        </tr>
        <tr>
          <td>Code Required</td>
          <td>menu li a:hover::before {
            transform-origin: left;
            transform: scaleX(1);
            }</td>
        </tr>
        <tr>
          <td>Link</td>
          <td>Hover your mouse over the buttons of the hotbar</td>
        </tr>
      </table>
    </div>
  </section>

  <?php include('footer.inc'); ?>
</body>

</html>