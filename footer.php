<footer>
  <style>
    footer {
      background: rgb(70, 97, 123);
      color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
      padding: 40px 2rem;
      box-shadow: 0 -3px 15px rgba(0, 0, 0, 0.2);
    }

    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
      text-align: center;
    }

    .footer-left {
      flex: 1 1 auto;
    }

    .footer-left p {
      margin: 0;
      font-weight: 600;
      font-size: 1.1rem;
    }

    .footer-left .footer-line {
      width: 80%;
      height: 1px;
      background-color: rgba(255, 255, 255, 0.25);
      margin: 10px auto;
    }

    .social-icons {
      display: flex;
      gap: 18px;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
    }

    .social-icons a {
      color: #f1f1f1;
      font-size: 1.6rem;
      transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-icons a:hover {
      color: #ffd166;
      transform: scale(1.25);
    }

    #back-to-top {
      background: transparent;
      border: none;
      cursor: pointer;
      transition: transform 0.3s ease;
      font-size: 2rem;
      color:rgb(196, 96, 161);
    }

    #back-to-top:hover {
      transform: scale(1.2);
    }
  </style>

  <div class="footer-container">
    <div class="footer-left">
      <p>&copy; 2025 Edutafly | All rights reserved.</p>
      <div class="footer-line"></div>
      <div class="social-icons">
        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
      </div>
    </div>

    <button id="back-to-top" aria-label="Back to top" title="Back to top">
      <i class="bi bi-arrow-up-circle-fill"></i>
    </button>
  </div>

  <script>
    document.getElementById('back-to-top').addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  </script>
</footer>
