<div class="modal fade" id="solarCalcModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none;">
      <div class="modal-header" style="background: var(--primary-color); color: white;">
        <h5 class="modal-title"><i class="ri-sun-fill me-2"></i>Solar Savings Calculator</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="solarForm">
            <div class="mb-3">
                <label class="form-label fw-bold">Average Monthly Bill ($)</label>
                <input type="number" id="monthlyBill" class="form-control" placeholder="e.g. 150">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Roof Sunlight Exposure</label>
                <select id="sunExposure" class="form-select">
                    <option value="1.0">Full Sun (No Shade)</option>
                    <option value="0.8">Partial Shade</option>
                    <option value="0.6">Mostly Shaded</option>
                </select>
            </div>
            <button type="button" onclick="calculateSolar()" class="btn btn-warning w-100 fw-bold text-dark">Calculate Savings</button>
        </form>

        <div id="calcResult" class="mt-4 p-3 bg-light rounded text-center" style="display:none;">
            <p class="text-muted mb-1">Estimated Annual Savings:</p>
            <h2 class="text-success fw-bold" id="savingsAmount">$0</h2>
            <p class="small text-muted mt-2">Based on current local energy rates. <a href="#contact" data-bs-dismiss="modal">Contact us</a> for a precise quote.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function calculateSolar() {
    const bill = parseFloat(document.getElementById('monthlyBill').value);
    const sun = parseFloat(document.getElementById('sunExposure').value);
    
    if(!bill) return;

    // Simple estimation logic (customize multipliers for your region)
    // Assuming 20% savings minimum + sun factor
    const annualBill = bill * 12;
    const savings = annualBill * 0.3 * sun; // Rough 30% savings algorithm

    const savingsFormatted = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(savings);
    
    document.getElementById('savingsAmount').innerText = savingsFormatted;
    document.getElementById('calcResult').style.display = 'block';
}
</script>