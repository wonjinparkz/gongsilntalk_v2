<div class="design-system-buttons" style="padding: 30px; background: white;">
    <h2 style="font-size: 28px; font-weight: 700; color: #333; margin-bottom: 40px; padding-bottom: 15px; border-bottom: 2px solid #007FFF;">
        🔘 Modern Button System
    </h2>
    
    <!-- New Button System -->
    <div style="margin-bottom: 60px; padding: 30px; background: linear-gradient(135deg, #E3F2FD 0%, #F5F5F5 100%); border-radius: 12px;">
        <h3 style="font-size: 24px; color: #007FFF; margin-bottom: 30px;">✨ New Button System (.btn)</h3>
        
        <!-- Button Sizes -->
        <div style="margin-bottom: 40px;">
            <h4 style="font-size: 18px; color: #555; margin-bottom: 20px;">Button Sizes</h4>
            <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap; padding: 25px; background: white; border-radius: 8px;">
                <button class="btn btn-primary btn-lg">Large Button (btn-lg)</button>
                <button class="btn btn-primary btn-md">Medium Button (btn-md)</button>
                <button class="btn btn-primary btn-sm">Small Button (btn-sm)</button>
                <button class="btn btn-primary">Default Button</button>
            </div>
        </div>
        
        <!-- Button Colors -->
        <div style="margin-bottom: 40px;">
            <h4 style="font-size: 18px; color: #555; margin-bottom: 20px;">Button Colors</h4>
            <div style="display: grid; gap: 20px;">
                <!-- Primary Buttons -->
                <div style="padding: 25px; background: white; border-radius: 8px;">
                    <h5 style="font-size: 14px; color: #666; margin-bottom: 15px;">Primary Buttons (Blue #007FFF)</h5>
                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <button class="btn btn-primary">btn-primary</button>
                        <button class="btn btn-outline-primary">btn-outline-primary</button>
                        <button class="btn btn-ghost">btn-ghost</button>
                        <button class="btn btn-primary" disabled>Disabled</button>
                    </div>
                </div>
                
                <!-- Secondary Buttons -->
                <div style="padding: 25px; background: white; border-radius: 8px;">
                    <h5 style="font-size: 14px; color: #666; margin-bottom: 15px;">Secondary Buttons (Black #000000)</h5>
                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <button class="btn btn-secondary">btn-secondary</button>
                        <button class="btn btn-outline-secondary">btn-outline-secondary</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Full Width Buttons -->
        <div style="margin-bottom: 40px;">
            <h4 style="font-size: 18px; color: #555; margin-bottom: 20px;">Full Width Buttons</h4>
            <div style="max-width: 400px; display: grid; gap: 15px; padding: 25px; background: white; border-radius: 8px;">
                <button class="btn btn-primary btn-full btn-lg">btn-full btn-lg</button>
                <button class="btn btn-outline-primary btn-full">btn-full btn-outline-primary</button>
                <button class="btn btn-secondary btn-full btn-sm">btn-full btn-sm</button>
            </div>
        </div>
        
        <!-- Button with Icons -->
        <div style="margin-bottom: 40px;">
            <h4 style="font-size: 18px; color: #555; margin-bottom: 20px;">Buttons with Icons (gap: 8px)</h4>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; padding: 25px; background: white; border-radius: 8px;">
                <button class="btn btn-primary">
                    <span>➕</span> Add Item
                </button>
                <button class="btn btn-outline-primary">
                    <span>📝</span> Edit
                </button>
                <button class="btn btn-ghost">
                    <span>🔍</span> Search
                </button>
                <button class="btn btn-secondary">
                    <span>⚙️</span> Settings
                </button>
            </div>
        </div>
        
        <!-- Code Examples -->
        <div>
            <h4 style="font-size: 18px; color: #555; margin-bottom: 20px;">Usage Examples</h4>
            <div style="background: #1e1e1e; color: #d4d4d4; padding: 20px; border-radius: 8px; font-family: 'Courier New', monospace; font-size: 14px; overflow-x: auto;">
                <div style="color: #608b4e; margin-bottom: 10px;">/* New Button System */</div>
                <div style="margin-bottom: 15px;">
                    <span style="color: #569cd6;">&lt;button</span> <span style="color: #9cdcfe;">class=</span><span style="color: #ce9178;">"btn btn-primary"</span><span style="color: #569cd6;">&gt;</span>Primary Button<span style="color: #569cd6;">&lt;/button&gt;</span>
                </div>
                <div style="margin-bottom: 15px;">
                    <span style="color: #569cd6;">&lt;button</span> <span style="color: #9cdcfe;">class=</span><span style="color: #ce9178;">"btn btn-outline-primary btn-lg"</span><span style="color: #569cd6;">&gt;</span>Large Outline<span style="color: #569cd6;">&lt;/button&gt;</span>
                </div>
                <div style="margin-bottom: 15px;">
                    <span style="color: #569cd6;">&lt;button</span> <span style="color: #9cdcfe;">class=</span><span style="color: #ce9178;">"btn btn-ghost btn-sm"</span><span style="color: #569cd6;">&gt;</span>Small Ghost<span style="color: #569cd6;">&lt;/button&gt;</span>
                </div>
                <div>
                    <span style="color: #569cd6;">&lt;button</span> <span style="color: #9cdcfe;">class=</span><span style="color: #ce9178;">"btn btn-primary btn-full"</span><span style="color: #569cd6;">&gt;</span>Full Width<span style="color: #569cd6;">&lt;/button&gt;</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CSS Variables -->
    <div style="margin-bottom: 50px;">
        <h3 style="font-size: 20px; color: #555; margin-bottom: 25px;">CSS Variables</h3>
        <div style="padding: 25px; background: #f8f8f8; border-radius: 8px;">
            <code style="display: block; background: white; padding: 20px; border-radius: 4px; font-size: 13px; line-height: 1.6;">
                :root {<br>
                &nbsp;&nbsp;--btn-primary-color: #007FFF;<br>
                &nbsp;&nbsp;--btn-primary-hover: #0066CC;<br>
                &nbsp;&nbsp;--btn-primary-active: #0052A3;<br>
                &nbsp;&nbsp;--btn-secondary-color: #000000;<br>
                &nbsp;&nbsp;--btn-secondary-hover: #007FFF;<br>
                &nbsp;&nbsp;--btn-padding-lg: 16px 32px;<br>
                &nbsp;&nbsp;--btn-padding-md: 12px 24px;<br>
                &nbsp;&nbsp;--btn-padding-sm: 8px 16px;<br>
                &nbsp;&nbsp;--btn-radius: 8px;<br>
                }
            </code>
        </div>
    </div>
    
    <!-- Legacy Button System (for reference) -->
    <div style="background: #f5f5f5; padding: 30px; border-radius: 12px;">
        <h3 style="font-size: 20px; color: #999; margin-bottom: 25px;">Legacy Button System (기존 시스템 - 호환성 유지)</h3>
        <div style="display: grid; gap: 20px;">
            <div style="padding: 20px; background: white; border-radius: 8px;">
                <h4 style="font-size: 14px; color: #666; margin-bottom: 15px;">Legacy Primary Buttons</h4>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <button class="btn_point btn_md">btn_point</button>
                    <button class="btn_point_ghost btn_md">btn_point_ghost</button>
                </div>
            </div>
            
            <div style="padding: 20px; background: white; border-radius: 8px;">
                <h4 style="font-size: 14px; color: #666; margin-bottom: 15px;">Legacy Gray Buttons</h4>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <button class="btn_gray btn_md">btn_gray</button>
                    <button class="btn_gray_ghost btn_md">btn_gray_ghost</button>
                    <button class="btn_graydeep_ghost btn_md">btn_graydeep_ghost</button>
                    <button class="btn_graylight_ghost btn_md">btn_graylight_ghost</button>
                </div>
            </div>
        </div>
    </div>
</div>