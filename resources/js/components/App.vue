<template>
    <div class="container">
        <v-btn v-if="!requests[0] && !chargeActivated" @click="charge">Cargar Request</v-btn>
        <v-btn @click="inform">Generar Informe</v-btn>

        <v-data-table
            :headers="headers"
            :items="myRequests"
            sort-by="time"
            sort-asc
        >
            <template v-slot:item.action="{ item }">
                <v-btn @click="seeStatus(item.id)">Ver status</v-btn>
            </template>
        </v-data-table>

        <v-snackbar
            v-model="snackbar"
            top
        >
            Esto podria tardar un poco
            <v-btn
                color="pink"
                text
                @click="snackbar = false"
            >
                Close
            </v-btn>
        </v-snackbar>
        <v-card
            class="mx-auto"
            color="#26c6da"
            dark
            max-width="400"
            v-if="dialog"
        >
            <v-card-title>
                <span class="title font-weight-light">Status Seleccionado</span>
            </v-card-title>

            <v-card-text class="headline font-weight-bold">
                <template v-for="status in dialog">
                    <h2>Ascensor {{status.elevator_id}}: </h2>
                    <h3>{{findFloor(status.floor_id).name}}</h3>
                </template>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
    import { mapActions, mapState, mapGetters, mapMutations } from 'vuex';

    export default {
        computed: {
            ...mapState([
                'requests'
            ]),
            myRequests: function () {
                let self = this;
                return Object.values(this.requests).map(function (item) {
                    item.from_floor_id = self.findFloor(item.from_floor_id).name;
                    item.to_floor_ids = self.findFloor(item.to_floor_ids).name;
                    return item;
                });
            },

            ...mapGetters([
                'findFloor'
            ]),
        },
        data () {
            return {
                headers: [
                    {
                        text: 'Origen',
                        align: 'left',
                        value: 'from_floor_id',
                    },
                    { text: 'Destino', value: 'to_floor_ids' },
                    { text: 'Hora', value: 'time' },
                    { text: 'Ascensor', value: 'elevator_id' },
                    { text: 'Plantas recorridas en la petición', value: 'floors_on_request' },
                    { text: 'Plantas recorridas hasta la llegada', value: 'floors_on_movement' },
                    { text: 'Actions', value: 'action', sortable: false }
                ],
                chargeActivated: false,
                informActivated: false,
                snackbar: false,
                dialog: null,
            }
        },
        mounted() {
            let self = this;
            this.fetchRequests();
            this.fetchFloors();
        },
        methods: {
            ...mapActions([
                'fetchRequests',
                'fetchFloors',
                'transform',
                'turnOn',
                'getStatus',
            ]),
            ...mapMutations({
                'mutateRequests': 'requests',
            }),
            charge () {
                let self = this;
                this.snackbar = true;
                self.chargeActivated = true;
                this.transform().then(function () {
                    self.fetchRequests();
                });
            },
            inform() {
                let self = this;
                this.mutateRequests([]);
                this.snackbar = true;
                self.informActivated = true;
                this.turnOn().then(function () {
                    self.fetchRequests();
                });
            },
            seeStatus(id) {
                let self = this;
                this.snackbar = true;
                self.dialog = null;
                this.getStatus(id).then(function(data) {
                    self.dialog = data;
                });
            }
        },
    }
</script>
