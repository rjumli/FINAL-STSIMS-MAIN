<template>
    <div class="p-4 d-flex flex-column h-100">
        <div class="mt-auto">
            <b-row class="g-1">
                <b-col lg="4">
                    <button @click="openDownload()" class="btn btn-soft-primary btn-sm w-100" type="button">
                        <div class="btn-content"> Import </div>
                    </button>
                </b-col>
                <b-col lg="4">
                    <button @click="openBank()" class="btn btn-soft-primary btn-sm w-100" type="button">
                        <div class="btn-content"> Bank Account </div>
                    </button>
                </b-col>
                <b-col lg="4">
                    <button @click="openBank()" class="btn btn-primary btn-sm w-100" type="button">
                        <div class="btn-content"> Update</div>
                    </button>
                </b-col>
            </b-row>
        </div>
    </div>
    <Import ref="download" @info="refresh()"/>
    <Bank ref="bank"/>
</template>
<script>
import Bank from './Modals/Bank.vue';
import Import from './Modals/Import.vue';
export default {
    components : { Import, Bank},
    data(){
        return {
            currentUrl: window.location.origin,
            statistics: { statuses: [], types: [], active:[], sync: '' },
            options: ['Ongoing Scholars','Graduated Scholars','Total Scholars'],
            options2: ['Undegraduate Scholarhip','Junior Level Science Scholarship'],
            colors: ['text-primary','text-info','text-success'],
            type: ''
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        fetch(){
            axios.get(this.currentUrl + '/scholars', {
                params: { type: 'statistics'}
            })
            .then(response => {
                this.statistics = response.data;
            })
            .catch(err => console.log(err));
        },
        openDownload(){
            this.$refs.download.show();
        },
        openBank(){
            this.$refs.bank.show();
        },
        refresh(){
            this.fetch();
            this.$emit('info',true);
        },
    }
}
</script>