<template>
    <div>
        <div class="form-group col-sm-12">
            <label>Email Server:</label>
            <select class="form-control" name="protocol"  v-model="data.protocol">
                <option value="mail" class="form-control">
                    mail
                </option>
                <option value="sendmail" class="form-control">
                    sendmail
                </option>
                <option value="smtp" class="form-control">
                    SMTP
                </option>
            </select>
        </div>

        <div>
            <h3>Email Settings</h3>
        </div>
        <!--PHP Mail-->
        <div v-show="isMail">
            <p><strong>Mail</strong> uses the standard PHP mail function, so no settings are necessary.</p>
        </div>
        <!--SendMail-->
        <div id="sendmail" class='subsection' v-show="isSendMail">
            <div class="form-group col-sm-12">
                <label>Send Mail Path:</label>
                <input type="text" name="mailpath" class="form-control" v-model="data.mailpath">
            </div>
        </div>
        <!--SMTP-->
        <div id="smtp" class='subsection' v-show="isSMTP">
            <div class="form-group col-sm-12">
                <label>SMTP Server Address:</label>
                <input type="text" name="smtp_host" class="form-control" v-model="data.smtp_host">
            </div>

            <div class="form-group col-sm-12">
                <label>SMTP Username:</label>
                <input type="text" name="smtp_user" class="form-control"  v-model="data.smtp_user">
            </div>
            <div class="form-group col-sm-12">
                <label>SMTP Password:</label>
                <input type="text" name="smtp_pass" class="form-control" v-model="data.smtp_pass">
            </div>
            <div class="form-group col-sm-12">
                <label>SMTP Port:</label>
                <input type="text" name="smtp_port" class="form-control" v-model="data.smtp_port">
            </div>
            <div class="form-group col-sm-12">
                <label>SMTP timeout (seconds):</label>
                <input type="text" name="smtp_timeout" class="form-control" v-model="data.smtp_timeout">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SettingEmailForm",
        props: {
            model: {
                type: Object,
                default: function () {
                }
            },
        },
        methods: {},
        data() {
            return {
                data: {}
            };
        },
        mounted() {
            this.data = this.model;
        },
        computed: {
            isMail() {
                return this.data.protocol == 'mail';
            },
            isSendMail() {
                return this.data.protocol == 'sendmail';
            },
            isSMTP() {
                return this.data.protocol == 'smtp';
            }
        }
    }
</script>

<style scoped>

</style>