<template>
  <modal
    ref="childmodal"
    name="catlisher_detail"
    :scrollable="true"
    :height="'auto'"
    :width="'80%'"
    :style="'z-index:1000'"
    @closed="hideModal"
  >
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div
              class="
                iq-card-header
                d-flex
                justify-content-between
                align-items-center
              "
            >
              <h4 class="card-title mb-0">Tags Information Preview</h4>
            </div>
            <div class="iq-card-body pb-0">
              <div class="description-contens align-items-top row">
                <div class="col-md-12">
                  <div class="row align-items-center">
                    <div class="col">
                      <div
                        class="
                          iq-card-transparent
                          iq-card-block
                          iq-card-stretch
                          iq-card-height
                        "
                      >
                        <div class="iq-card-body p-0">
                          <p>
                            <span
                              >Last Modified by:
                              <b
                                >{{
                                  data.modified_by == null
                                    ? data.created_by
                                    : data.modified_by
                                }}
                                ,
                              </b></span
                            >
                            <span>
                              <b>
                                {{
                                  moment(data.modified_at).format(
                                    "YYYY/MM/DD H:mm:ss a"
                                  )
                                }}</b
                              ></span
                            >
                          </p>
                          <p
                            v-if="data.deleted_at != null"
                            class="iq-card-body p-1 text-danger"
                          >
                            <span
                              >Deleted by: <b>{{ data.deleted_by }}</b></span
                            >,
                            <span
                              >At :
                              <b>{{
                                moment(data.deleted_at).format(
                                  "YYYY/MM/DD H:mm:ss a"
                                )
                              }}</b></span
                            >
                          </p>
                          <h3 class="mb-3">
                            {{ data.name }}
                          </h3>
                          <span
                            class="text-dark mb-4 pb-4 iq-border-bottom d-block"
                            v-html="data.description"
                          ></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <b-tabs>
                    <!-- General -->
                    <b-tab
                      no-body
                      title="General"
                      @click="loading_books(data.id)"
                    >
                      <div
                        class="
                          iq-card iq-card-block iq-card-stretch iq-card-height
                        "
                      >
                        <div
                          class="
                            iq-card-header
                            d-flex
                            justify-content-between
                            align-items-center
                            position-relative
                          "
                        ></div>
                        <div class="iq-header-title">
                          <h3 class="card-title mb-0">
                            The Books Belong To The Tags: "{{ data.name }}"
                          </h3>
                        </div>
                        <b-overlay :show="check" rounded="sm">
                          <div class="iq-card-body">
                            <div class="row" v-if="list.length > 0">
                              <div
                                v-for="item in list"
                                :key="item.book_id"
                                class="col-sm-6 col-md-4 col-lg-3"
                              >
                                <div
                                  class="
                                    iq-card
                                    iq-card-block
                                    iq-card-stretch
                                    iq-card-height
                                    browse-bookcontent
                                  "
                                >
                                  <div class="iq-card-body p-0">
                                    <div class="d-flex align-items-center">
                                      <div
                                        class="
                                          col-6
                                          p-0
                                          position-relative
                                          image-overlap-shadow
                                        "
                                      >
                                        <a href="javascript:void();"
                                          ><img
                                            v-if="item.img != null"
                                            class="img-fluid rounded w-100"
                                            :src="'/' + item.img"
                                            alt=""
                                          /><img
                                            v-else
                                            class="img-fluid rounded w-100"
                                            src="/images/books/default.jpg"
                                            alt=""
                                          />
                                        </a>
                                        <div class="view-book">
                                          <a
                                            href="javascript:void(0)"
                                            class="btn btn-sm btn-white"
                                            @click="
                                              remove(data.id, item.book_id)
                                            "
                                            >Remove from tags</a
                                          >
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="mb-2">
                                          <h5 class="mb-1">
                                            {{
                                              $root.truncate(
                                                item.book_name,
                                                50,
                                                "..."
                                              )
                                            }}
                                          </h5>
                                          <div class="d-block line-height">
                                            <span
                                              class="font-size-11 text-primary"
                                              v-for="author in item.author"
                                              :key="author.id"
                                            >
                                              {{ author.name + " " }}
                                            </span>
                                          </div>
                                        </div>
                                        <div
                                          v-if="item.promotion_price != null"
                                          class="
                                            price
                                            d-flex
                                            align-items-center
                                          "
                                        >
                                          <span class="pr-1 old-price">{{
                                            item.price
                                              | currency("đ", 0, {
                                                symbolOnLeft: false,
                                                spaceBetweenAmountAndSymbol: true,
                                              })
                                          }}</span>
                                          <h6>
                                            <b>{{
                                              item.promotion_price
                                                | currency("đ", 0, {
                                                  symbolOnLeft: false,
                                                  spaceBetweenAmountAndSymbol: true,
                                                })
                                            }}</b>
                                          </h6>
                                        </div>
                                        <div
                                          v-else
                                          class="price align-items-center"
                                        >
                                          <h6>
                                            <span>
                                              <b>{{
                                                item.price
                                                  | currency("đ", 0, {
                                                    symbolOnLeft: false,
                                                    spaceBetweenAmountAndSymbol: true,
                                                  })
                                              }}</b>
                                            </span>
                                          </h6>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div v-else>
                              <p>{{ mess }}</p>
                            </div>
                          </div>
                        </b-overlay>
                      </div>
                    </b-tab>
                  </b-tabs>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </modal>
</template>
<script>
import moment from "moment";
export default {
  props: ["detail"],
  data() {
    return {
      data: this.detail,
      check: true,
      list: [],
      mess: "",
    };
  },
  methods: {
    remove(tags_id, book_id) {
      axios
        .delete("/admin/tags/remove_book/tags_id=" + tags_id + "&&" + "book_id=" + book_id)
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          if (response.data.status == "success") {
            this.data = response.data.data;
          }
        });
    },
    show_model: function (item) {
      this.$modal.show("catlisher_detail");
      this.loading_books(item.id);
      return (this.data = item);
    },
    moment: function () {
      return moment();
    },
    loading_books(id) {
      this.get_list_books(id);
      setTimeout(() => {
        this.check = false;
      }, 1000);
    },
    hideModal() {
      return (this.list = []), (this.show = true), (this.mess = "");
    },
    get_list_books(id) {
      console.log("Loading ......");
      axios
        .get("/admin/tags/" + id)
        .then((response) => {
          this.list = response.data.data;
          this.$root.makeToast(response.data.status, response.data.mess);
          console.log("Done");
        })
        .catch((err) => {
          this.mess = "NOT FOUND";
          this.list = [];
        });
    },
  },
};
</script>

<style scoped>
</style>