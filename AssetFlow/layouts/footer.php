<footer class="dashboard-footer">
    <div class="footer-container">
        <span class="footer-copyright">© <?= date('Y') ?> <strong><?= APP_NAME ?></strong>. All rights reserved.</span>
        <span class="footer-version">Version <?= APP_VERSION ?></span>
    </div>
</footer>

</div> <!-- Closes .main -->

</div> <!-- Closes .wrapper -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>

<!-- AssetFlow JS -->
<script src="<?= BASE_URL ?>assets/js/app.js"></script>

</body>

</html>