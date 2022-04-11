<script>
export default {
    props: ['trainList']
}
</script>

<template>
    <v-simple-table>
        <thead>
            <th>Line</th>
            <th>Destination</th>
            <th>ETA</th>
        </thead>
        <tbody>
            <tr
                v-for="(item, index) in trainList"
                :key="index"
            >
                <td>{{ item.Line }}</td>
                <td>{{ item.DestinationName }}</td>
                <td>{{ item.Min }}</td>
            </tr>
        </tbody>
    </v-simple-table>
</template>
