
<template>

    <div class="spin"></div>

</template>

<style>
.spin {
    display: block;
    width: 100px;
    height: 100px;
    margin: 100px auto;
    border: 3px solid transparent;
    border-radius: 50%;
    border-top-color: #ff8800;
    animation: spin 1s ease infinite;
}
@keyframes spin {
    to { transform: rotateZ(360deg); }
}
</style>
