<template>
  <table
    id="datatable"
    class="data-tables table table-striped table-bordered fixed"
    style="width: 100%"
  >
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Date Create</th>
        <th>Date Update</th>
        <th>Modified By</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="value in format" :key="value.id">
        <td>{{ value.id }}</td>
        <td>{{ value.name }}</td>
        <td>
          {{ value.description }}
        </td>
        <td>{{ datetime(value.created_at) }}</td>
        <td>{{ datetime(value.modified_at) }}</td>
        <td>
          {{ value.modified_by == null ? value.created_by : value.modified_by }}
        </td>
        <td>
          <div class="flex align-items-center list-user-action">
            <a
              class="bg-primary"
              data-toggle="tooltip"
              :data-text="value.id"
              data-placement="top"
              title="Detail"
              data-original-title="Detail"
              @click="showModal(value)"
            >
              <i class="ri-file-fill"></i
            ></a>
            <a
              class="bg-primary option-edit"
              data-toggle="tooltip"
              data-placement="top"
              title="Edit"
              data-original-title="Edit"
              :href="'/admin/type/type-edit-view/' + value.id"
              ><i class="ri-pencil-line"></i
            ></a>
            <a
              v-if="value.deleted_at != null"
              class="bg-primary option-restore"
              data-toggle="tooltip"
              data-placement="top"
              title="Restore"
              data-original-title="Restore"
              :href="'/admin/type/type-restore/' + value.id"
              ><i class="fa fa-undo"></i
            ></a>
            <a
              v-else
              class="bg-primary option-delete"
              data-toggle="tooltip"
              data-placement="top"
              title="Delete"
              data-original-title="Delete"
              :href="'/admin/type/type-delete/' + value.id"
              ><i class="ri-delete-bin-line"></i
            ></a>
          </div>
        </td>
      </tr>
    </tbody>
    <modal-booktype
      :detail="data[0]"
      ref="reference"
    ></modal-booktype>
  </table>
</template>

<script>
Vue.component("modal-booktype", require("./modal/booktype.vue").default);
import moment from "moment";
export default {
  props: ["data"],
  components: { moment },
  data() {
    return {
      format: [],
    };
  },
  methods: {
    datetime(date) {
      return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
    },
    timeago(date) {
      return moment(date).startOf("hours").fromNow();
    },
    showModal(item) {
      this.$refs.reference.show_model(item);
    },
  },
  mounted() {
    this.format = this.data;
  },
  created() {
    $(document).ready(function () {
      $.noConflict();
      var table = $("#datatable").DataTable({});
      new $.fn.dataTable.Buttons($("#datatable"), {
        buttons: [
          {
            extend: "copyHtml5",
            exportOptions: {
              columns: [0, 1, 3, 4, 5],
            },
            className: " btn-outline-primary",
            text: "Copy to clipboard",
            key: {
              key: "C",
              altkey: true,
            },
            titleAttr: "Press C on the keyboard or click into to Copy ",
          },
          {
            extend: "excelHtml5",
            className: " btn-outline-primary",
            exportOptions: {
              columns: [0, 1, 3, 4, 5],
            },
            text: "Export to Excel",
            key: {
              key: "E",
              altkey: true,
            },
            titleAttr: "Press E on the keyboard or click into to Export ",
          },
          {
            extend: "pdfHtml5",
            exportOptions: {
              columns: [0, 1, 3, 4, 5],
            },
            className: " btn-outline-primary",
            text: "Export to PDF",
            key: {
              key: "D",
              altkey: true,
            },
            download: "open",
            titleAttr: "Press D on the keyboard or click into to Export ",
          },
          {
            extend: "csvHtml5",
            exportOptions: {
              columns: [0, 1, 3, 4, 5],
            },
            className: " btn-outline-primary",
            text: "Export to CSV",
            key: {
              key: "V",
              altkey: true,
            },
            titleAttr: "Press V on the keyboard or click into to Export ",
          },
          {
            extend: "print",
            exportOptions: {
              columns: [0, 1, 3, 4, 5],
            },
            className: "buttons-html5 btn-outline-primary",
            text: "Print",
            key: {
              key: "p",
              altkey: true,
            },
            titleAttr: "Press P on the keyboard or click into to print",
          },
        ],
      });

      table.buttons(0, null).container().prependTo(table.table().container());
    });
  },
};
</script>
<style>
</style>