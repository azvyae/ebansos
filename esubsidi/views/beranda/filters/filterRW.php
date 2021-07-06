<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        siapkanFilterRT('<?= $data['user']['rw'] ?>');
    })
</script>
<div class="row justify-content-between">
    <div id="filterRT" class="col-lg-2 mb-2">
        <select hidden class="form-select filter mb-2" id="rt" name='rt'>
        </select>
    </div>