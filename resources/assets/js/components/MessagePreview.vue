<template>
    <div class="image-container">
        <img src="\images\i-phone.png" alt="" style="width: 100%;">
        <div class="img-top-left">{{message}}</div>
    </div>
</template>

<script>
    export default {
        name: "MessagePreview",
        props: {
            message: {
                type: String,
                default: ''
            }
        }
    }
</script>

<style scoped>
    .img-container {
        position: relative;
        text-align: center;
        color: white;
    }

    /* Bottom left text */
    .img-top-left {
        position: absolute;
        top: 23%;
        left: 17%;
        width: 62%;
        height: 19%;
        overflow: hidden;
        word-wrap: break-word;
    }
</style>
