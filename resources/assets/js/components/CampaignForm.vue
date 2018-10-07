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
                <label for="delivery">Delivery:</label>
                <select class="form-control col-sm-3" id="delivery" name="delivery" v-model="data.delivery">
                    <option v-for="(value, key) in deliveries" :key="key" :value="key">{{value}}</option>
                </select>
                <div class="row">
                    <div class="col-md-12 datetime-group">
                        <date-picker v-model="data.date"
                                     type="date" lang="en"
                                     format="YYYY-MM-DD"
                                     v-show="isDeliveryOther">
                        </date-picker>
                        <date-picker v-model="data.time"
                                     type="time"
                                     lang="en"
                                     format="hh:mm"
                                     placeholder="Select time"
                                     v-show="isDeliveryOther">
                        </date-picker>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="routine_appointment">Routine Appointment:</label>
                <select class="form-control col-sm-3" id="routine_appointment" name="routine_appointment"
                        v-model="data.routine_appointment">
                    <option value="" disabled selected>None</option>
                    <option v-for="(value, key) in routingAppointments" :key="key" :value="key">
                        {{value}}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="template_id">Template:</label>
                <select class="form-control col-sm-3" id="template_id" name="template_id" v-model="data.template_id">
                    <option v-for="template in templates" :value="template.id">
                        {{template.name}}
                    </option>
                </select>
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
                <label>Phone/Group:</label>
                <label class="radio-inline">
                    <input type="radio" name="send_to" value="0" v-model="data.send_to">Phone
                </label>
                <label class="radio-inline">
                    <input type="radio" name="send_to" value="1" v-model="data.send_to">Group
                </label>
            </div>

            <div class="form-group" v-show="isPhone">
                <label for="phones">To Phone:</label>
                <textarea name="phones" type="text" id="phones" class="form-control" v-model="data.phones">
                </textarea>
            </div>

            <div class="form-group" v-show="!isPhone">
                <label for="group_id">To Group:</label>
                <select class="form-control" id="group_id" name="group_id" v-model="data.group_id">
                    <option v-for="group in groups" :value="group.id">{{group.name}}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="media">Media file:</label>
                <input name="media" type="file" id="media" class="form-control">
            </div>

        </div>
    </div>
</template>

<script>
    import MessagePreview from "./MessagePreview";
    import StringRemainingLimit from './StringRemainingLimit';

    export default {
        name: "CampaignForm",
        components: {MessagePreview, StringRemainingLimit},
        props: {
            model: {
                type: Object,
                default: function () {
                    return {
                        delivery: 0,
                        send_type: 0,
                        use_bot: 0,
                        message: '',
                        send_to: 0,
                        routine_appointment: ''
                    }
                }
            },
            deliveries: {
                type: Array,
                default: () => []
            },
            routingAppointments: {
                type: Array,
                default: () => []
            },
            templates: {
                type: Array,
                default: () => []
            },
            records: {
                type: Array,
                default: () => []
            },
            groups: {
                type: Array,
                default: () => []
            }
        },
        data() {
            return {
                data: {}
            };
        },
        mounted() {
            this.data = this.model;
        },
        computed: {
            isDeliveryOther() {
                return this.data.delivery === 6
            },
            isSMS() {
                return this.data.send_type == 0;
            },
            isBot() {
                return this.data.use_bot == 1
            },
            isPhone() {
                return this.data.send_to == 0;
            }
        },
        watch: {
            'data.template_id'(newVal, oldVal) {
                if (oldVal === undefined) return;
                console.log('change', newVal, oldVal);
                let template = this.templates.find((item) => item.id === newVal);
                if (template) {
                    this.data = Object.assign({}, this.data, {
                        send_type: template.send_type,
                        use_bot: template.use_bot,
                        message: template.message,
                        record_id: template.record_id
                    })
                }
            }
        }
    }
</script>

<style scoped>
    .datetime-group {
        margin-top: 10px;
    }
</style>
