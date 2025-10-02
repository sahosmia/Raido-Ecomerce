from playwright.sync_api import sync_playwright, expect

def run(playwright):
    browser = playwright.chromium.launch(headless=True)
    context = browser.new_context()
    page = context.new_page()

    try:
        # 1. Navigate to the homepage
        page.goto("http://127.0.0.1:8000")

        # 2. Find and click the "Contact" link in the header
        contact_link = page.get_by_role("link", name="Contact")
        expect(contact_link).to_be_visible()
        contact_link.click()

        # Let's wait for navigation to be sure
        page.wait_for_load_state("networkidle")

        # Take a screenshot for debugging
        page.screenshot(path="jules-scratch/verification/contact_page_debug.png")
        print("Debug screenshot saved to jules-scratch/verification/contact_page_debug.png")

        # 3. Assert that the page navigated to the contact page
        # We can check for a unique element on the contact page, like the heading.
        # I'll assume the contact page has a heading "Contact Us".
        # If this fails, I'll inspect the page to find a better selector.
        expect(page.get_by_role("heading", name="Contact Us")).to_be_visible()

        # 4. Take a screenshot for visual verification
        page.screenshot(path="jules-scratch/verification/contact_page.png")
        print("Screenshot saved to jules-scratch/verification/contact_page.png")

    except Exception as e:
        print(f"An error occurred: {e}")
        page.screenshot(path="jules-scratch/verification/error.png")
        print("Error screenshot saved to jules-scratch/verification/error.png")

    finally:
        # Clean up
        context.close()
        browser.close()

with sync_playwright() as playwright:
    run(playwright)