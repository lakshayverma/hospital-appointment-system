</div>
<footer id="footer" class="jumbotron">
    <h2>
        <strong>Mandeep Kaur</strong>, <em>146438712</em>
    </h2>
    
    <h4><span class="glyphicon glyphicon-copyright-mark"></span> <?php echo date("Y", time()); ?></h4>
    
    <small>
        This website has been developed only for educational purposes and has no link with any real hospital.
    </small>
</footer>

<script type="text/javascript" src="styles/js/jquery-2.1.3.js"></script>
<script type="text/javascript" src="styles/js/bootstrap.min.js"></script>

</body>
</html>
<?php if (isset($database)) {
    $database->close_connection();
} ?>