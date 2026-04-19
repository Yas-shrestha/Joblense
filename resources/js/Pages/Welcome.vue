<template>
    <div
        style="
            max-width: 720px;
            margin: 40px auto;
            font-family: sans-serif;
            padding: 0 20px;
        "
    >
        <h1 style="font-size: 24px; margin-bottom: 4px">JobLens</h1>
        <p style="color: #666; margin-bottom: 24px">
            {{ localApps.length }} applications tracked
        </p>
        <div
            style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 4px;
            "
        >
            <h1 style="font-size: 24px; margin: 0">JobLens</h1>
            <button
                @click="logout"
                style="
                    font-size: 13px;
                    color: #999;
                    background: none;
                    border: none;
                    cursor: pointer;
                "
            >
                Logout
            </button>
        </div>
        <!-- Form -->
        <div
            style="
                border: 1px solid #e5e5e5;
                border-radius: 10px;
                padding: 20px;
                margin-bottom: 32px;
                background: #fafafa;
            "
        >
            <h2 style="font-size: 16px; margin: 0 0 16px">
                Log a new application
            </h2>

            <div
                style="
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 12px;
                    margin-bottom: 12px;
                "
            >
                <div>
                    <label style="font-size: 13px; color: #555">Company</label>
                    <input
                        v-model="form.company"
                        placeholder="e.g. Stripe"
                        style="
                            width: 100%;
                            margin-top: 4px;
                            padding: 8px 10px;
                            border: 1px solid #ddd;
                            border-radius: 6px;
                            font-size: 14px;
                            box-sizing: border-box;
                        "
                    />
                </div>
                <div>
                    <label style="font-size: 13px; color: #555">Role</label>
                    <input
                        v-model="form.role"
                        placeholder="e.g. Backend Engineer"
                        style="
                            width: 100%;
                            margin-top: 4px;
                            padding: 8px 10px;
                            border: 1px solid #ddd;
                            border-radius: 6px;
                            font-size: 14px;
                            box-sizing: border-box;
                        "
                    />
                </div>
            </div>

            <div style="margin-bottom: 16px">
                <label style="font-size: 13px; color: #555">Status</label>
                <select
                    v-model="form.status"
                    style="
                        width: 100%;
                        margin-top: 4px;
                        padding: 8px 10px;
                        border: 1px solid #ddd;
                        border-radius: 6px;
                        font-size: 14px;
                        background: white;
                    "
                >
                    <option value="Applied">Applied</option>
                    <option value="Interview">Interview</option>
                    <option value="Offer">Offer</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>

            <!-- Live preview -->
            <p
                v-if="form.company"
                style="font-size: 13px; color: #888; margin-bottom: 12px"
            >
                Preview: <strong>{{ form.company }}</strong> —
                {{ form.role || "no role yet" }}
                <StatusBadge :status="form.status" />
            </p>

            <button
                @click="addApplication"
                :disabled="!form.company || !form.role"
                :style="{ opacity: !form.company || !form.role ? 0.4 : 1 }"
                style="
                    padding: 9px 20px;
                    background: #111;
                    color: white;
                    border: none;
                    border-radius: 6px;
                    font-size: 14px;
                    cursor: pointer;
                    transition: opacity 0.2s;
                "
            >
                Add Application
            </button>
        </div>

        <!-- List -->
        <ApplicationCard
            v-for="job in localApps"
            :key="job.id"
            :job="job"
            @delete="removeApplication"
        />

        <!-- Empty state -->
        <p
            v-if="localApps.length === 0"
            style="color: #999; text-align: center; margin-top: 60px"
        >
            No applications yet. Start applying!
        </p>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import ApplicationCard from "../Components/ApplicationCard.vue";
import StatusBadge from "../Components/StatusBadge.vue";

const props = defineProps({
    appName: String,
    applications: Array,
});

const localApps = reactive([...props.applications]);

const form = reactive({
    company: "",
    role: "",
    status: "Applied",
});

function addApplication() {
    if (!form.company || !form.role) return;

    localApps.push({
        id: Date.now(),
        company: form.company,
        role: form.role,
        status: form.status,
        date: new Date().toLocaleDateString("en-US", {
            month: "short",
            day: "numeric",
        }),
    });

    form.company = "";
    form.role = "";
    form.status = "Applied";
}

function removeApplication(id) {
    // findIndex finds the position of the item with this id
    const index = localApps.findIndex((job) => job.id === id);

    // splice removes 1 item at that position
    if (index !== -1) localApps.splice(index, 1);
}
function logout() {
    router.post("/logout");
}
</script>
