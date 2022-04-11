<script>
export default {
    emits: ['change'],

    data() {
        return {
            values:[],
            items:[],

            stations: [],
            loading: true,
            error: null,

            onChange: (value) => this.$emit('change', value)
        };
    },

    mounted() {
        axios.get('/api/station')
            .then(response => {
                this.stations = response.data.Stations;
                this.loading = false;

                this.items = this.stations.map(x => ({
                    text: x.Name,
                    value: x.Code
                }));

                console.log('loaded', this);
            })
            .catch(e => this.error = e);
    }
}
</script>

<template>
    <v-card>
        <v-container fluid>
        <v-row
            align="center"
        >
            <v-col cols="12">
                <div v-if="loading">Loading Station List</div>
                <v-autocomplete
                    v-if="!loading"
                    :items="items"
                    outlined
                    dense
                    chips
                    small-chips
                    label="Selection Station"
                    @change="onChange"
                    hint="Select from the list or start typing the name of a station to search"
                    persistent-hint
                ></v-autocomplete>

            </v-col>
        </v-row>
        </v-container>
    </v-card>
</template>
