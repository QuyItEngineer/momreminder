<template>
    <div>
        <div class="col-sm-3">
            <message-preview :message="data.message"></message-preview>
        </div>
        <div class="col-sm-9">
            <div class="form-group">
                <label for="name">Name:</label>
                <input name="name" type="text" id="name" class="form-control" v-model="data.name">
            </div>

            <div class="form-group">
                <label>Send Type:</label>
                <label class="radio-inline">
                    <input type="radio" name="send_type" value="0" v-model="data.send_type">SMS/MMS
                </label>
                <label class="radio-inline">
                    <input type="radio" name="send_type" value="1" v-model="data.send_type">Voice
                </label>
            </div>

            <div class="form-group" v-show="!isSMS">
                <label>Use bot:</label>
                <label class="radio-inline">
                    <input type="radio" name="use_bot" value="1" v-model="data.use_bot">Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="use_bot" value="0" v-model="data.use_bot">No
                </label>
            </div>

            <div class="form-group" v-show="isSMS || isBot">
                <label for="message">Message:</label>
                <textarea name="message" id="message" class="form-control" v-model="data.message" maxlength="160"></textarea>
                <string-remaining-limit v-model="data.message"></string-remaining-limit>
            </div>

            <div class="form-group" v-show="!isBot && !isSMS">
                <label for="record_id">Voice file(record):</label>
                <select class="form-control" id="record_id" name="record_id" v-model="data.record_id">
                    <option v-for="record in records" :value="record.id">{{record.name}}</option>
                </select>
            </div>
            <div class="form-group">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import StringRemainingLimit from './StringRemainingLimit';
    import MessagePreview from './MessagePreview'

    export default {
        name: "TemplateForm",
        components: {MessagePreview, StringRemainingLimit},
        comments: {
            StringRemainingLimit,
            MessagePreview
        },
        props: {
            model: {
                type: Object,
                default: function() {
                    return {
                        send_type: 0,
                        use_bot: 0,
                        message: ''
                    }
                }
            },
            records: {
                type: Array,
                default: function() {
                    return [];
                }
            }
        },
        data() {
            return {
                data: {
                }
            };
        },

        mounted() {
            this.data = this.model;
        },

        computed: {
            isSMS() {
                return this.data.send_type == 0;
            },
            isBot() {
                return this.data.use_bot == 1
            }
        }
    }
</script>

<style scoped>
</style>
