<template>
  <div v-if="loading" style="heigth: 100%">
    <div class="card shadow p-1 rounded">
      <div class="card-body d-flex justify-content-around">
        <div class="spinner-grow text-success center" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>

  <div v-else>
    <div class="row page-titles">
      <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Profile</h3>
      </div>
    </div>
    <!-- Row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow p-1 rounded">
          <!-- Tabs -->
          <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="pills-profile-tab"
                data-toggle="pill"
                href="#last-month"
                role="tab"
                aria-controls="pills-profile"
                aria-selected="true"
                ><i class="fas fa-child"></i> Profile</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="pills-setting-tab"
                data-toggle="pill"
                href="#previous-month"
                role="tab"
                aria-controls="pills-setting"
                aria-selected="false"
                ><i class="fas fa-cogs"></i> Setting</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="pills-setting-tab"
                data-toggle="pill"
                href="#password-tab"
                role="tab"
                aria-controls="pills-setting"
                aria-selected="false"
                ><i class="fas fa-key"></i> Password</a
              >
            </li>
          </ul>
          <!-- Tabs -->
          <div class="tab-content" id="pills-tabContent">
            <div
              class="tab-pane fade active show"
              id="last-month"
              role="tabpanel"
              aria-labelledby="pills-profile-tab"
            >
              <div class="card">
                <div class="card-body">
                  <center class="mt-4">
                    <span
                      class="rounded-circle bg-success text-center display-1 w-100 p-3 font-weight-bold"
                      width="150"
                      v-text="
                        (userObj.name ? userObj.name.substring(0, 1) : null) +
                        (userObj.last_name ? userObj.last_name.substring(0, 1) : null)
                      "
                    >
                    </span>
                    <h4 class="card-title mt-2">
                      <b v-text="userObj.name"></b><b></b>
                      <b v-text="userObj.last_name"></b>
                    </h4>
                    <h6 class="card-subtitle" v-text="userObj.cf_1704"></h6>
                    <div class="row text-center justify-content-md-center"></div>
                  </center>
                </div>
                <div>
                  <hr />
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <small class="text-muted">Email </small>
                      <h6 v-text="userObj.email"></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Edit profile -->
            <div
              class="tab-pane fade"
              id="previous-month"
              role="tabpanel"
              aria-labelledby="pills-setting-tab"
            >
              <div class="card-body">
                <form
                  class="form-horizontal form-material"
                  enctype="multipart/form-data"
                  autocomplete="nope"
                >
                  <!--  <input
                    autocomplete="off"
                    name="hidden"
                    type="text"
                    style="display: none"
                  /> -->
                  <div class="form-group" autocomplete="none">
                    <label for="select2-search-hide">Select branch</label>
                    <select
                      class="select2 form-control custom-select"
                      id="select2-search-hide"
                      style="width: 100%"
                      v-model="selectedBranch"
                      @change="selectBranch"
                    >
                      <option v-for="branch in branches" :value="branch">
                        <p>
                          {{ branch.division }}
                        </p>
                        <br />
                      </option>
                    </select>
                  </div>

                  <div class="form-group" autocomplete="none">
                    <label class="col-md-12" for="name">Name</label>
                    <div class="col-md-12">
                      <input
                        type="text"
                        placeholder="John"
                        class="form-control form-control-line"
                        id="name"
                        v-model="userObj.name"
                        autocomplete="off"
                      />
                    </div>
                  </div>

                  <div class="form-group" autocomplete="none">
                    <label for="last_name" class="col-md-12">Last name</label>
                    <div class="col-md-12">
                      <input
                        type="tel"
                        placeholder="123 456 7890"
                        class="form-control form-control-line"
                        id="last_name"
                        v-model="userObj.last_name"
                        autocomplete="off"
                      />
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-12">
                      <a href="#" class="btn btn-success" v-on:click="updateAccount()">
                        Update Profile
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- change password -->
            <div
              class="tab-pane fade"
              id="password-tab"
              role="tabpanel"
              aria-labelledby="pills-setting-tab"
            >
              <div class="card-body">
                <form
                  class="form-horizontal form-material"
                  method="get"
                  autocomplete="nope"
                >
                  <input
                    autocomplete="off"
                    name="hidden"
                    type="text"
                    style="display: none"
                  />
                  <section autocomplete="disabled">
                    <div class="form-group" autocomplete="nope">
                      <label class="col-md-12" for="inputPass">Old password</label>
                      <div class="col-md-12">
                        <input
                          class="form-control form-control-line"
                          v-model="old_password"
                          name="inputPass"
                          type="password"
                          autocomplete="nope"
                          required
                        />
                        <small
                          v-if="submitted && errors.old_password"
                          class="text-danger font-14"
                          >{{ errors.old_password }}</small
                        >
                      </div>
                    </div>
                    <div class="form-group" autocomplete="nope">
                      <label class="col-md-12" for="inputPass">New Password</label>
                      <div class="col-md-12">
                        <input
                          class="form-control form-control-line"
                          v-model="new_password"
                          name="inputPass"
                          type="password"
                          autocomplete="nope"
                          required
                        />
                      </div>
                    </div>
                    <div class="form-group" autocomplete="nope">
                      <label class="col-md-12" for="inputPass"
                        >Confirm new Password</label
                      >
                      <div class="col-md-12">
                        <input
                          class="form-control form-control-line"
                          v-model="confirm_password"
                          name="inputPass"
                          type="password"
                          autocomplete="nope"
                          required
                        />
                      </div>
                    </div>
                    <small
                      v-if="submitted && errors.password"
                      class="text-danger font-14"
                      >{{ errors.password }}</small
                    >
                  </section>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <a href="#" class="btn btn-success" v-on:click="updatePassword()">
                        Update Password
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Column -->
    </div>
  </div>
</template>

<script>
import DisableAutocomplete from "vue-disable-autocomplete";
Vue.use(DisableAutocomplete);

export default {
  data() {
    return {
      loading: false,
      id: "",
      message: "",
      new_password: "",
      old_password: "",
      confirm_password: "",

      user_donotcall: false,
      user_emailoptout: false,
      userObj: {},
      submitted: false,
      errors: {},
      branches: [],
      selectedBranch: null,
    };
  },
  mounted() {
    this.userAccount();
  },

  methods: {
    getBranches() {
      let me = this;

      axios
        .get("api/branches")
        .then((response) => {
          console.log(response);

          //   console.log(response);
          me.branches = response.data;
        })
        .catch((error) => {
          console.table(error);
        });
    },

    selectBranch(event) {
      const branch = JSON.parse(
        JSON.stringify(event.target.options[event.target.options.selectedIndex])
      )._value;

      console.log(branch);
      this.selectedBranch = branch;
    },

    userAccount() {
      this.getBranches();
      let me = this;
      this.loading = true;
      axios
        .get("/account")
        .then(function (response) {
          me.userObj = response.data;
          console.log(response);
          console.log(me.userObj);
          this.$emit("userBranch");
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },

    updateAccount() {
      this.submitted = true;
      this.errors = {};
      //   this.valideForm();

      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        return;
      }
      let me = this;
      axios
        .post("/account", {
          name: me.userObj.name,
          last_name: me.userObj.last_name,
          branch: me.selectedBranch.id,
        })
        .then(function (response) {
          //   console.log(response);
          Swal.fire({
            type: "success",
            title: "Account updated",
            timer: 2000,
            showConfirmButton: false,
          });
          me.userAccount();
        })
        .catch(function (error) {
          Swal.fire({
            type: "error",
            title: "Account wasn't updated !",
            timer: 2000,
            showConfirmButton: false,
          });
          console.log(error);
        });
      window.location.reload();
    },

    updatePassword() {
      let me = this;
      me.submitted = true;
      me.errors = {};
      me.validePass();
      console.log(Object.keys(me.errors));
      if (Object.keys(me.errors).length) {
        return;
      }
      axios
        .post("/new_password", {
          contact_no: me.userObj.contact_no,
          old_password: me.old_password,
          new_password: me.new_password,
          confirm_password: me.confirm_password,
        })
        .then(function (response) {
          Swal.fire({
            type: "success",
            title: "Password changed",
            timer: 2000,
            showConfirmButton: false,
          });
        })
        .catch(function (error) {
          Swal.fire({
            type: "error",
            title: "Password not was updated !",
            timer: 2000,
            showConfirmButton: false,
          });
          console.table(error);
        });
    },

    //Validar campos requeridos
    validePass() {
      if (this.old_password !== this.userObj.cf_1780) {
        this.errors.old_password = "Incorrect old password";
      }
      if (!this.password && !this.confirm_password) {
        this.errors.password = "Password fields cant be blank";
      }
      if (this.new_password !== this.confirm_password) {
        this.errors.password = "Password and  confirm not equals";
      }
    },

    /*   valideForm() {
      this.valideUrlField("userObj.cf_2254", "skype");
      this.valideUrlField("userObj.cf_2246", "facebook");
      this.valideUrlField("userObj.cf_2252", "instagram");
      this.valideUrlField("userObj.cf_2250", "linkedin");
    },

    valideUrlField(field, as) {
      let fail;
      if (field === "userObj.cf_2254") fail = this.userObj.cf_2254;
      if (field === "userObj.cf_2246") fail = this.userObj.cf_2246;
      if (field === "userObj.cf_2252") fail = this.userObj.cf_2252;
      if (field === "userObj.cf_2250") fail = this.userObj.cf_2250;

      console.log(field);
      console.log(fail);

      if (
        !/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/i.test(
          fail
        ) &&
        fail !== ""
      ) {
        this.errors[
          as
        ] = `The ${as} field is not valid url. try some 'http://${as}.com/profile'`;
      }
    }, */
  },
};
</script>
