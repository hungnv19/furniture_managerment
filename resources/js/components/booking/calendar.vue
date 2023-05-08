<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card p-3">
            <v-row class="fill-height">
              <v-col>
                <FullCalendar :options="calendarOptions" />
              </v-col>
            </v-row>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

export default {
  components: {
    FullCalendar,
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        selectable: true,
        select: this.handleDateSelect,
        events: this.handleEvent,
        // events: this.events1,
        dateClick: this.handleDateClick,
      },
    };
  },

  methods: {
    handleDateClick: function (arg) {
      alert("Date: " + arg.dateStr);
    },
    handleEvent() {
      axios
        .get("/get-booking")
        .then((response) => {
          this.events1 = response.data;
          console.log(this.events1);
        })
        .catch();
    },
  },
};
</script>