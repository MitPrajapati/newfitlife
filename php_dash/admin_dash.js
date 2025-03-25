document.addEventListener("DOMContentLoaded", function () {
    console.log("🚀 DOM fully loaded!");
    loadClasses();
  // ========================== SIDEBAR NAVIGATION ========================== //
  function showSection(sectionId) {
    document
      .querySelectorAll(".section")
      .forEach((section) => section.classList.remove("active"));
    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
      activeSection.classList.add("active");
    } else {
      console.error("Section not found:", sectionId);
    }
  }

  document.querySelectorAll(".sidebar ul li a").forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const sectionId = this.getAttribute("data-section");
      showSection(sectionId);
    });
  });

  // ========================== ADD TRAINERS FUNCTION ========================== //
  async function loadTrainers() {
    try {
      let response = await fetch("php_dash/fetch_trainers.php");
      let text = await response.text();
      console.log("📜 Trainer Fetch Response:", text);

      let data = JSON.parse(text);
      if (!data.success) {
        console.error("❌ Fetch error:", data.error);
        return;
      }

      let tableBody = document.getElementById("trainerTableBody");
      tableBody.innerHTML = "";

      data.data.forEach((trainer) => {
        let row = document.createElement("tr");
        row.innerHTML = `
                    <td>${trainer.id}</td>
                    <td>${trainer.name}</td>
                    <td>${trainer.email}</td>
                    <td>${trainer.expertise}</td>
                `;
        tableBody.appendChild(row);
      });
    } catch (error) {
      console.error("❌ Error fetching trainers:", error);
    }
  }

  async function addTrainer() {
    const name = document.getElementById("trainerName").value.trim();
    const email = document.getElementById("trainerEmail").value.trim();
    const expertise = document.getElementById("trainerExpertise").value.trim();

    if (!name || !email || !expertise) {
      alert("❗ All fields are required.");
      return;
    }

    try {
      const response = await fetch("php_dash/add_trainer.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, email, expertise }),
      });

      const text = await response.text();
      console.log("📜 Add Trainer Response:", text);

      let result = JSON.parse(text);
      if (result.success) {
        alert("✅ Trainer added successfully!");
        loadTrainers();
      } else {
        alert("❌ Failed to add trainer: " + (result.error || "Unknown error"));
      }
    } catch (error) {
      console.error("❌ Error adding trainer:", error);
    }
  }

  // ========================== LOGOUT FUNCTION ========================== //
  document.querySelector(".logout-btn").addEventListener("click", function () {
    alert("Logging out...");
    window.location.href = "login.html";
  });

  // ========================== FETCH USER REGISTRATION & LOGIN DATA ========================== //
  async function fetchData() {
    try {
      const response = await fetch("admin_dash.php");
      if (!response.ok) throw new Error("Network response was not ok");
      const text = await response.text();
      console.log("Raw Response:", text);
      const data = JSON.parse(text);

      if (!data || !data.registrations || !data.logins) {
        console.error("Invalid response format:", data);
        return;
      }

      document.getElementById("registrationTableBody").innerHTML =
        data.registrations
          .map(
            (user) => `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.joined_date}</td>
                </tr>
            `
          )
          .join("");

      document.getElementById("loginTableBody").innerHTML = data.logins
        .map(
          (login) => `
                <tr>
                    <td>${login.id}</td>
                    <td>${login.name}</td>
                    <td>${login.email}</td>
                    <td>${login.login_time ?? "N/A"}</td>
                </tr>
            `
        )
        .join("");
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  }

  // ========================== Classes Details ========================== //
  // ========================== LOAD CLASSES ========================== //
  async function loadClasses() {
    try {
        const response = await fetch("fetch_classes.php");
        const text = await response.text();
        console.log("📜 Raw Fetch Response:", text); // Full API response

        const data = JSON.parse(text);
        console.log("✅ Parsed Data:", data);

        if (!data.success) {
            console.error("❌ Fetch error:", data.error);
            return;
        }

        const tableBody = document.getElementById("classTableBody");
        if (!tableBody) {
            console.error("❌ Table body not found!");
            return;
        }

        tableBody.innerHTML = ""; // Clear table

        data.data.forEach(item => {
            console.log("🔹 Adding Class to Table:", item); // Log each class item
            let row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.id}</td>
                <td>${item.class_name}</td>
                <td>${item.trainer_name ?? "N/A"}</td>
                <td>${item.schedule}</td>
                <td>${item.duration}</td>
                <td>${item.capacity}</td>
                <td>${item.location}</td>
                <td>${item.status}</td>
                <td>${item.created_at ?? "N/A"}</td>
                <td><button class="delete-btn" data-id="${item.id}">🗑️Remove</button></td>
            `;
            tableBody.appendChild(row);
        });

    } catch (error) {
        console.error("❌ Error fetching classes:", error);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    loadClasses();
});


  // ========================== Trainers Load ========================== //
  async function loadTrainers() {
    try {
        let response = await fetch("fetch_trainers.php");
        let text = await response.text();
        console.log("📜 Trainer Fetch Response:", text);

        let data = JSON.parse(text);
        if (!data.success) {
            console.error("❌ Fetch error:", data.error);
            return;
        }

        let tableBody = document.getElementById("trainerTableBody");
        tableBody.innerHTML = "";

        data.data.forEach(trainer => {
            let row = document.createElement("tr");
            row.innerHTML = `
                <td>${trainer.id}</td>
                <td>${trainer.name}</td>
                <td>${trainer.email}</td>
                <td>${trainer.expertise}</td>
                <td>${trainer.created_at ?? "N/A"}</td>  <!-- FIX: Display created_at -->
                <td><button class="delete-trainer-btn" data-id="${trainer.id}">🗑️ Remove</button></td>
            `;
            tableBody.appendChild(row);
        });

    } catch (error) {
        console.error("❌ Error fetching trainers:", error);
    }
}


  // Call this function on page load
  document.addEventListener("DOMContentLoaded", function () {
    loadTrainers();
  });
  // ========================== Delete Trainer HISTORY ========================== //
  async function deleteTrainer(trainerId) {
    if (!confirm("Are you sure you want to delete this trainer?")) return;

    try {
        const response = await fetch("php_dash/delete_trainer.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ trainer_id: trainerId }),
        });

        const text = await response.text();
        console.log("📜 Raw Delete Trainer Response:", text);

        let result = JSON.parse(text);
        if (result.success) {
            alert("✅ Trainer deleted successfully!");
            loadTrainers(); // Refresh trainer list
        } else {
            alert("❌ Failed to delete trainer: " + (result.error || "Unknown error"));
        }
    } catch (error) {
        console.error("❌ Error deleting trainer:", error);
    }
}

// Add event listener for delete buttons
document.addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-trainer-btn")) {
        const trainerId = event.target.getAttribute("data-id");
        deleteTrainer(trainerId);
    }
});


  // ========================== LOAD PAYMENT HISTORY ========================== //
  async function loadPaymentHistory() {
    try {
      let response = await fetch("fetch_payments.php");
      let text = await response.text(); // Capture raw response
      console.log("📜 Raw Response:", text); // Debugging log

      let data = JSON.parse(text); // Convert JSON
      if (!data.success) {
        console.error("❌ Fetch error:", data.error);
        return;
      }

      let tableBody = document.getElementById("paymentTableBody");
      tableBody.innerHTML = "";

      data.data.forEach((payment) => {
        let row = document.createElement("tr");
        row.innerHTML = `
                    <td>${payment.id}</td>
                    <td>${payment.name}</td>
                    <td>${payment.email}</td>
                    <td>${payment.plan}</td>
                    <td>₹${payment.amount}</td>
                    <td>${payment.payment_date}</td>
                    <td><button class="delete-btn" data-id="${payment.id}">🗑️ Remove</button></td>
                `;
        tableBody.appendChild(row);
      });
    } catch (error) {
      console.error("❌ Error fetching payment history:", error);
    }
  }

  // ========================== DELETE PAYMENT FUNCTION ========================== //
  async function deletePayment(paymentId) {
    if (!confirm("Are you sure you want to delete this payment?")) return;

    try {
      const response = await fetch("php_dash/delete_payment.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ payment_id: paymentId }),
      });

      const text = await response.text();
      console.log("Raw Delete Response:", text);

      let result = JSON.parse(text);
      if (result.success) {
        alert("Payment deleted successfully!");
        loadPaymentHistory();
      } else {
        alert("Failed to delete payment: " + (result.error || "Unknown error"));
      }
    } catch (error) {
      console.error("Error deleting payment:", error);
    }
  }

  // ========================== EVENT LISTENERS FOR BUTTONS ========================== //
  document
    .getElementById("addTrainerBtn")
    ?.addEventListener("click", addTrainer);

  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-btn")) {
      const paymentId = event.target.getAttribute("data-id");
      deletePayment(paymentId);
    }
  });

  // ========================== LOAD DATA ON PAGE LOAD ========================== //
  fetchData();
  loadPaymentHistory();
  loadTrainers();
});
